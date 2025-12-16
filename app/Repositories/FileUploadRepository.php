<?php

namespace App\Repositories;

use App\Models\Upload;
use App\Repositories\Interfaces\FileUploadRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadRepository implements FileUploadRepositoryInterface
{
    /**
     * Upload the file with a random or custom file name and return its metadata.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @param  string $directory
     * @param  string|null $fileName Custom file name
     * @return array File metadata
     */
    public function upload($file)
    {
        if (env('APP_DEBUG') === true && env('APP_ENV') === 'local') {
            $directory = 'uploads/local';
        } else {
            $directory = 'uploads/all';
        }

        // Generate a random 64-character file name if no custom name is provided
        $originalFileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '-' . Str::random(64) . '.' . $extension;
        $mime_type = $file->getMimeType();
        $fileSize = $file->getSize();
        $file->move(public_path($directory), $fileName);
        return [
            'file_path' => $directory . '/' . $fileName,
            'file_name' => $fileName,
            'original_name' => $originalFileName,
            'extension' => $extension,
            'size' => $fileSize,
            'mime_type' => $mime_type,
            'file_type' => $this->getFileType($mime_type),
        ];
    }

    /**
     * Get the URL of the uploaded file.
     *
     * @param  string $filePath
     * @return string File URL
     */
    public function getFileUrl($filePath, $secure = null)
    {
        if (env('FILESYSTEM_DISK') === 'local') {
            return app('url')->asset($filePath, $secure);
        }
    }
    
    /**
     * Delete the file from storage.
     *
     * @param  string $filePath
     * @return bool True on success, false on failure
     */
    public function delete($file)
    {
        $upload = Upload::find($file);
        if ($upload) {
            if (Storage::disk(env('FILESYSTEM_DISK'))->exists($upload->file_path)) {
                $file_delete = Storage::disk(env('FILESYSTEM_DISK'))->delete($upload->file_path);
                Log::debug($file_delete);
                if ($file_delete) {
                    $upload->delete();
                    return true;
                }
                return false;
            }
            return false;
        }
        return false;
    }

    // public function delete($filePath)
    // {
    //     // Normalize slashes to match the operating system
    //     $filePath = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $filePath);

    //     // Convert to absolute path
    //     $filePathN = public_path($filePath);

    //     // Debugging - check if the file path is correct
    //     // if (!file_exists($filePathN)) {
    //     //     dd("File does not exist", $filePathN);
    //     // }

    //     // dd($filePathN, file_exists($filePathN), scandir(dirname($filePathN)));

    //     // Delete the file
    //     if (unlink($filePathN)) {
    //         return true;
    //     }

    //     return false;
    // }
    /**
     * Determine the file type based on MIME type.
     *
     * @param  string $mimeType
     * @return string
     */
    protected function getFileType($mimeType)
    {
        if (strpos($mimeType, 'image') !== false) {
            return 'image';
        } elseif (strpos($mimeType, 'video') !== false) {
            return 'video';
        } elseif (strpos($mimeType, 'audio') !== false) {
            return 'audio';
        } elseif (strpos($mimeType, 'application/pdf') !== false) {
            return 'document';
        } else {
            return 'other';
        }
    }
}
