<?php

namespace App\Handlers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use lsolesen\pel\PelEntryAscii;
use lsolesen\pel\PelExif;
use lsolesen\pel\PelIfd;
use lsolesen\pel\PelJpeg;
use lsolesen\pel\PelTag;
use lsolesen\pel\PelTiff;

class FileHandler extends Controller {
    /**
     * Trim from the beginning of a path
     *
     * @param string $path
     * @param string $prefix
     * @return string $trimmedPath
     **/
    protected static function trimPath($path, $prefix) {
        $trimmedPath = $path;
        if (substr($trimmedPath, 0, strlen($prefix)) == $prefix) {
            return $trimmedPath = substr($trimmedPath, strlen($prefix));
        }
    }

    /**
     * Creates a file object to be used inside of a controller
     *
     * @param array $array
     * @return object $object
     **/
    protected static function createFileObject(Array $array) {
        $publicPath = self::trimPath($array['fullPath'], 'public');

        // Create the Object
        $object = (object) [
            'fileNameWithExt' => $array['fileNameWithExt'],
            'fileName' => $array['fileName'],
            'extension' => $array['extension'],
            'fileNameToStore' => $array['fileNameToStore'],
            'fullPath' => $array['fullPath'],
            'publicPath' => '/storage' . $publicPath
        ];

        return $object;
    }

    /**
     * Handles uploading a file to the storage folder.
     *
     * @param Illuminate\Http\Request $request
     * @param string $storageFolder
     * @param string $formName
     * @return self::createFileObject()
     **/
    public static function uploadFile(Request $request, $storageFolder = 'noPath', $formName = 'fileUpload') {
        // Define Storage Path
        $storagePath = 'public/' . $storageFolder;
        // Get filename with extension
        $fileNameWithExt = $request->file($formName)->getClientOriginalName();
        // Get just the filename
        $filename = Str::slug(pathinfo($fileNameWithExt, PATHINFO_FILENAME));
        // Get just the extension
        $extension = $request->file($formName)->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        // Define the Full Path To Storage
        $fullPath = $storagePath . '/' . $fileNameToStore;
        // Create a compressed version of the image
        $image = Image::make($request->file($formName))
            ->fit(300)
            ->encode('jpg');
        // Save the image using the storage facade
        Storage::put($fullPath, $image->__toString());

        // ------------------------------------
        // Handle all the MetaData
        // ------------------------------------

        // Return an Array of Exif Data to later be used by PelJpeg
        $exifData = (new self)->getExifData($image);
        // Define the path for PelJpeg to use
        $pelfile = public_path("/storage/{$storageFolder}/{$fileNameToStore}");
        // Set the MetaData
        $jpeg = (new self)->setExifData($pelfile, $exifData);
        // Save the PelJpeg Image To Storage
        $jpeg->saveFile($pelfile);

        // Non-Image Intervention Save
        //$fullPath = $request->file($image)->storeAs($storagePath, $fileNameToStore);

        // Create an array of all relevant data
        $fileArray = [
            'fileNameWithExt' => $fileNameWithExt,
            'fileName' => $filename,
            'extension' => $extension,
            'fileNameToStore' => $fileNameToStore,
            'fullPath' => $fullPath
        ];

        return self::createFileObject($fileArray);
    }

    /**
     * Handles replacing a file in the storage folder.
     * Passes to uploadFile Method, then returns file object
     *
     * @param Illuminate\Database\Eloquent\Model $resource
     * @param Illuminate\Http\Request $request
     * @param string $storageFolder
     * @param string $formName
     * @return self::createFileObject()
     **/
    public static function replaceFile(Model $resource, Request $request, $storageFolder = 'noPath', $formName = 'fileUpload') {
        // Delete the old file
        Storage::delete($resource->fullPath);
        // Place the new file
        return self::uploadFile($request, $storageFolder, $formName);
    }

    /**
     * Handles file deletion from the storage folder
     *
     * @param Illuminate\Database\Eloquent\Model $resource
     * @return bool true
     **/
    public static function deleteFile(Model $resource) {
        Storage::delete($resource->fullPath);
        return true;
    }

    private function getExifData($image) {
        // Get the Exif Data from the image
        $exif = $image->exif();
        // Put Relevant Data Into An Array To Save Later
        $arr['COPYRIGHT'] = $exif['Copyright'];
        $arr['ARTIST'] = $exif['Artist'];
        $arr['IMAGE_WIDTH'] = $exif['COMPUTED']['Width'];
        $arr['IMAGE_LENGTH'] = $exif['COMPUTED']['Height'];
        $arr['X_RESOLUTION'] = $exif['XResolution'];
        $arr['Y_RESOLUTION'] = $exif['YResolution'];

        return $arr;

    }

    private function setExifData(string $pelfile, $exifData) {
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

        echo nl2br("No IFD, adding new.\n\n");
        $ifd0 = new PelIfd(PelIfd::IFD0);
        $tiff->setIfd($ifd0);

        /*
         * Each entry in an IFD is identified with a tag. This will load the
         * ImageDescription entry if it is present. If the IFD does not
         * contain such an entry, null will be returned.
         */
        foreach($exifData as $key => $value) {
            echo nl2br("Key Is: {$key}\n");
            echo nl2br("Value Is: {$value}\n");
            echo nl2br("----------------------------\n");
            $tag = constant("lsolesen\pel\PelTag::$key");
            $entry = new PelEntryAscii($tag, $value);
            $ifd0->addEntry($entry);
            echo nl2br("Added new {$key} entry with: " . $value . "\n\n");
        }

        // Finally return the object back to be saved
        return $jpeg;

    }

} // End Class
