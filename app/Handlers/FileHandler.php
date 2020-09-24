<?php

namespace App\Handlers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileHandler extends Controller {

    /**
     * @param $fullPath
     * @return false|string
     */
    public static function makePublicPath($fullPath) {
        $prefix = 'public';
        if (substr($fullPath, 0, strlen($prefix)) == $prefix) {
            return $trimmedPath = substr($fullPath, strlen($prefix));
        }
    }

    /**
     * Handles uploading a file to the storage folder.
     *
     * @param Request $request
     * @param string $storageFolder
     * @param string $formFieldName
     * @return array|bool
     */
    public static function uploadFile(Request $request, $storageFolder = 'noPath', $formFieldName = 'fileUpload') {
        // Define File from Request
        $fileFromRequest = $request->file($formFieldName);

        // Get the File Properties to then be later stored in database
        $file = self::getFileProperties($fileFromRequest, $storageFolder);

        // If the file is an image
        if($file->type == 'image') {
            // Make the thumbnail, Preview, and Original Images then return the indexArray to then be saved by the controller
            return ImageHandler::makeImages($file);
        }

        // If nothing is returned then return false
        return false;
    }

    /**
     * Handles replacing a file in the storage folder.
     * Passes to uploadFile Method, then returns file object
     *
     * @param Model $resource
     * @param Request $request
     * @param string $storageFolder
     * @param string $formName
     * @return array|bool
     */
    public static function replaceFile(Model $resource, Request $request, $storageFolder = 'noPath', $formName = 'fileUpload') {
        // Delete the old file
        Storage::delete($resource->fullPath);
        // Place the new file
        return self::uploadFile($request, $storageFolder, $formName);
    }

    /**
     * Handles file deletion from the storage folder
     *
     * @param Model $resource
     * @return bool
     */
    public static function deleteFile(Model $resource) {
        if($resource instanceof \App\Models\Images\Image) {
            // if the resource being passed to the method is that of a portfolio image
            // Delete the images associated with that specific entry
            ImageHandler::deleteImages($resource);
        } else {
            // Do some code to delete the file.
            // To be coded later
            Session::flash('danger', 'FileHandler::deleteFile() detected that the passed resource was not an image.');
            return false;
        }

        return true;
    }

    /**
     * Get the properties of the uploaded file
     *
     * @param \Illuminate\Http\UploadedFile $fileFromRequest
     * @param string $storageFolder
     * @return object
     */
    private static function getFileProperties(\Illuminate\Http\UploadedFile $fileFromRequest, string $storageFolder) {
        // Define an Empty Array To Store Values In
        $file = [];
        // Store The File Properties In The Array
        $file['uploadedFile'] = $fileFromRequest;
        $file['storagePath'] = 'public/' . $storageFolder;
        $file['storageFolder'] = $storageFolder;
        $file['filenameWithExt'] = $fileFromRequest->getClientOriginalName();
        $file['filename'] = Str::slug(pathinfo($fileFromRequest->getClientOriginalName(), PATHINFO_FILENAME));
        $file['extension'] = $fileFromRequest->getClientOriginalExtension();
        $file['type'] = self::getFileType($file['extension']);

        return (object) $file;
    }

    /**
     * Gets the type of file being uploaded.
     * Returns the string of the file type, either image, or file
     * Will add video extensions later on - 9-23-2020
     *
     * @param string $extension
     * @return string
     */
    private static function getFileType(string $extension) {
        // Define Acceptable Image File Extensions
        $imageExtensions = ['jpg', 'jpeg', 'png', 'bmp', 'svg', 'gif'];

        // Check if file is an image
        if(in_array($extension, $imageExtensions)) {
            return 'image';
        }

        // File is not an image
        return 'file';
    }

} // End Class
