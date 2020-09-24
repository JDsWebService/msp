<?php

namespace App\Handlers;

use App\Models\Images\Image;
use App\Models\Images\Original;
use App\Models\Images\Preview;
use App\Models\Images\Thumbnail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as ImageIntervention;
use lsolesen\pel\PelEntryAscii;
use lsolesen\pel\PelExif;
use lsolesen\pel\PelIfd;
use lsolesen\pel\PelJpeg;
use lsolesen\pel\PelTiff;

class ImageHandler {

    // File that was passed to the Image Handler
    protected static $file;
    // Define the Encoded Image Extension
    protected static $extension;
    // Define Original Image Width & Height
    private static $originalWidth;
    private static $originalHeight;
    // Define Copyright & Artist
    private static $copyright;
    private static $artist;
    // Define X & Y Resolution
    private static $x_resolution;
    private static $y_resolution;
    // Define the thumbnail and preview sizes
    private static $thumbnail_size = ['width' => 380, 'height' => 380];
    private static $preview_size = ['width' => 725, 'height' => 600];

    public static function makeImages(object $file) {
        // Store the File Data into the class variable
        self::$file = $file;
        // Define the Image Extension
        self::$extension = 'jpg';
        // Define Empty Images Array
        $images = [];
        // Create Thumbnail Image
        $images['thumbnail']['file'] = ImageIntervention::make($file->uploadedFile)
                                        ->resize(null, self::$thumbnail_size['height'], function($constraint) {
                                            $constraint->aspectRatio();
                                            $constraint->upsize();
                                        })
                                        ->crop(self::$thumbnail_size['width'], self::$thumbnail_size['height'])
                                        //->resizeCanvas(self::$thumbnail_size['width'], self::$thumbnail_size['height'], 'center', false, array(255, 255, 255, 0))
                                        ->encode(self::$extension)->__toString();
        $images['thumbnail']['type'] = "thumbnail";
        $images['thumbnail']['fileName'] = $file->filename . '_' . time() . '_thumbnail';
        $images['thumbnail']['fileNameToStore'] = $file->filename . '_' . time() . '_thumbnail' . '.' . self::$extension;
        $images['thumbnail']['fullPath'] = $file->storagePath . '/thumbnails/' . $images['thumbnail']['fileNameToStore'];
        $images['thumbnail']['pelfile'] = public_path("/storage/{$file->storageFolder}/thumbnails/{$images['thumbnail']['fileNameToStore']}");
        // Create Preview Image
        $images['preview']['file'] = ImageIntervention::make($file->uploadedFile)
                                        ->resize(self::$preview_size['width'], self::$preview_size['height'], function($constraint) {
                                            $constraint->aspectRatio();
                                            $constraint->upsize();
                                        })
                                        ->encode(self::$extension)->__toString();
        $images['preview']['type'] = "preview";
        $images['preview']['fileName'] = $file->filename . '_' . time() . '_preview';
        $images['preview']['fileNameToStore'] = $file->filename . '_' . time() . '_preview' . '.' . self::$extension;
        $images['preview']['fullPath'] = $file->storagePath . '/previews/' . $images['preview']['fileNameToStore'];
        $images['preview']['pelfile'] = public_path("/storage/{$file->storageFolder}/previews/{$images['preview']['fileNameToStore']}");
        // Create Original Image
        $images['original']['file'] = file_get_contents($file->uploadedFile);
        $images['original']['type'] = "original";
        $images['original']['fileName'] = $file->filename . '_' . time() . '_original';
        $images['original']['fileNameToStore'] = $file->filename . '_' . time() . '_original' . '.' . self::$extension;
        $images['original']['fullPath'] = $file->storagePath . '/originals/' . $images['original']['fileNameToStore'];
        $images['original']['pelfile'] = public_path("/storage/{$file->storageFolder}/originals/{$images['original']['fileNameToStore']}");
        // Create Exif Data to be returned with the images
        $images['original']['exifData'] = self::getExifData(ImageIntervention::make($file->uploadedFile));

        // Return The Images To The File Handler for Upload
        return self::saveImages($images);

    }

    private static function saveImages(array $images) {
        foreach($images as $image) {
            // Save the image using the storage facade
            Storage::put($image['fullPath'], $image['file']);
        }

        return self::saveMetaData($images);
    }

    private static function saveMetaData(array $images) {

        // Return an Array of Exif Data to later be used by PelJpeg
        $exifData = $images['original']['exifData'];

        // Loop through all images
        foreach($images as $image) {
            // Define the path for PelJpeg to use
            $pelfile = $image['pelfile'];
            // echo nl2br("\$Pelfile is: " . $pelfile . "\n");
            // echo nl2br("Image Type Is: " . $image['type'] . "\n");
            // Set the Exif Data
            $pelImage = self::setExifData($pelfile, $exifData);
            // Save the PelJpeg Image To Storage
            $pelImage->saveFile($pelfile);
        }

        // Finally return an array with all the data needing to be saved in the database
        return self::getDatabaseInfo($images);

    }

    private static function getExifData($uploadedFile) {
        // Get the Exif Data from the image
        $exif = $uploadedFile->exif();

        // Define an array with keys but NULL values
        $arr = [
            'IMAGE_WIDTH' => null,
            'IMAGE_LENGTH' => null,
            'COPYRIGHT' => null,
            'ARTIST' => null,
            'X_RESOLUTION' => null,
            'Y_RESOLUTION' => null,
        ];

        // Put Relevant Data Into An Array To Save Later
        // Images will always have a width and length
        self::$originalWidth = $arr['IMAGE_WIDTH'] = $exif['COMPUTED']['Width'];
        self::$originalHeight = $arr['IMAGE_LENGTH'] = $exif['COMPUTED']['Height'];
        // Check to see if the rest of the values are set in the exif data
        if(array_key_exists('Copyright', $exif)) {
            self::$copyright = $arr['COPYRIGHT'] = $exif['Copyright'];
        }
        if(array_key_exists('Artist', $exif)) {
            self::$artist = $arr['ARTIST'] = $exif['Artist'];
        }
        if(array_key_exists('XResolution', $exif)) {
            self::$x_resolution = $arr['X_RESOLUTION'] = $exif['XResolution'];
        }
        if(array_key_exists('YResolution', $exif)) {
            self::$y_resolution = $arr['Y_RESOLUTION'] = $exif['YResolution'];
        }

        return $arr;
    }

    private static function setExifData(string $pelfile, $exifData) {
        // Create New PelJpeg Instance
        $jpeg = new PelJpeg($pelfile);

        /*
         * Create a new APP1 section (a PelExif
         * object) and adds it to the PelJpeg object.
         */
        $exif = new PelExif();
        $jpeg->setExif($exif);

        /* We then create an empty TIFF structure in the APP1 section. */
        $tiff = new PelTiff();
        $exif->setTiff($tiff);

        /*
         * TIFF data has a tree structure much like a file system. There is a
         * root IFD (Image File Directory) which contains a number of entries
         * and maybe a link to the next IFD. The IFDs are chained together
         * like this, but some of them can also contain what is known as
         * sub-IFDs. For our purpose we only need the first IFD, for this is
         * where the image description should be stored.

         * No IFD in the TIFF data? This probably means that the image
         * didn't have any Exif information to start with, and so an empty
         * PelTiff object was inserted by the code above. But this is no
         * problem, we just create and inserts an empty PelIfd object.
         */

        // echo nl2br("No IFD, adding new.\n");
        $ifd0 = new PelIfd(PelIfd::IFD0);
        $tiff->setIfd($ifd0);

        /*
         * Each entry in an IFD is identified with a tag. This will load the
         * ImageDescription entry if it is present. If the IFD does not
         * contain such an entry, null will be returned.
         */
        foreach($exifData as $key => $value) {
            // echo nl2br("Key Is: {$key}\n");
            // echo nl2br("Value Is: {$value}\n");
            $tag = constant("lsolesen\pel\PelTag::$key");
            $entry = new PelEntryAscii($tag, $value);
            $ifd0->addEntry($entry);
            // echo nl2br("Added new {$key} entry with: " . $value . "\n");
            // echo nl2br("----------------------------\n");
        }

        // Finally return the object back to be saved
        return $jpeg;

    }

    private static function getDatabaseInfo(array $images) {
        $DBArray = [];

        foreach($images as $image) {
            $DBArray[$image['type']] = (object) [
                'storagePath' => static::$file->storagePath,
                'storageFolder' => static::$file->storageFolder,
                'fileName' => $image['fileName'],
                'extension' => self::$extension,
                'fileNameToStore' => $image['fileNameToStore'],
                'fullPath' => $image['fullPath'],
                'publicPath' => FileHandler::makePublicPath($image['fullPath'])
            ];
        }

        // Save all the files to the database
        return self::saveImagesToDatabase($DBArray);
    }

    private static function saveImagesToDatabase(array $DBArray) {
        // Define Image Index Database Array
        $indexArray = [
            'copyright' => self::$copyright,
            'artist' => self::$artist,
            'x_resolution' => self::$x_resolution,
            'y_resolution' => self::$y_resolution,
            'width' => self::$originalWidth,
            'height' => self::$originalHeight,
        ];

        foreach($DBArray as $key => $value) {
            switch($key) {
                case "thumbnail":
                    $type = new Thumbnail();
                    break;
                case "preview":
                    $type = new Preview();
                    break;
                case "original":
                    $type = new Original();
                    break;
            }
            $type->storagePath = $value->storagePath;
            $type->storageFolder = $value->storageFolder;
            $type->fileName = $value->fileName;
            $type->extension = $value->extension;
            $type->fileNameToStore = $value->fileNameToStore;
            $type->fullPath = $value->fullPath;
            $type->publicPath = $value->publicPath;
            // Save To Database
            $type->save();
            // Save ID of Type To Index Array
            $indexArray[$key . '_id'] = $type->id;
        }

        return $indexArray;
    }

    /**
     * @param Image $resource
     * @return bool
     */
    public static function deleteImages(Image $resource) {
        // Get all Images
        $images = self::getAllImages($resource);

        foreach($images as $image) {
            // Remove from storage
            Storage::delete($image->fullPath);
            // Remove from database
            $image->delete();
        }

        return true;
    }

    private static function getAllImages(Image $image) {
        // Start a new blank array to store images
        $images = [];

        // Grab all Images and put them into the images array
        array_push($images, Thumbnail::where('id', $image->thumbnail_id)->first());
        array_push($images, Preview::where('id', $image->preview_id)->first());
        array_push($images, Original::where('id', $image->original_id)->first());

        return $images;
    }

}
