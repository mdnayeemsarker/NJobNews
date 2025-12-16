<?php

namespace App\Repositories\Interfaces;

interface FileUploadRepositoryInterface
{
    /**
     * Upload the file with a random or custom file name and return its metadata.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @param  string|null $fileName Custom file name
     * @return array File metadata
     */
    public function upload($file);

    /**
     * Get the URL of the uploaded file.
     *
     * @param  string $filePath
     * @return string File URL
     */
    
    public function getFileUrl($filePath);

    /**
     * Delete the file from storage.
     *
     * @param  string $filePath
     * @return bool True on success, false on failure
     */
    public function delete($filePath);
}
