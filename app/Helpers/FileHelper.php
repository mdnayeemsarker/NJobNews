<?php

namespace App\Helpers;

use App\Services\FileUploadService;

class FileHelper
{
    protected static $fileUploadService;

    /**
     * Set the FileUploadService instance.
     *
     * @param FileUploadService $fileUploadService
     */
    public static function setFileUploadService(FileUploadService $fileUploadService)
    {
        self::$fileUploadService = $fileUploadService;
    }

    /**
     * Get the FileUploadService instance.
     *
     * @return FileUploadService
     */
    protected static function getFileUploadService()
    {
        if (!self::$fileUploadService) {
            self::$fileUploadService = app(FileUploadService::class);
        }

        return self::$fileUploadService;
    }

    /**
     * Upload a file and return metadata.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @param string|null $fileName
     * @return array File metadata
     */
    public static function uploadFile($file, $directory = 'uploads', $fileName = null)
    {
        return self::getFileUploadService()->uploadFile($file, $directory, $fileName);
    }

    /**
     * Upload a file and return metadata.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @param string|null $fileName
     * @return array File metadata
     */
    public static function deleteFile($file)
    {
        return self::getFileUploadService()->deleteFile($file);
    }
}
