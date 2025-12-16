<?php

namespace App\Services;

use App\Events\FileUploaded;
use App\Repositories\Interfaces\FileUploadRepositoryInterface;

class FileUploadService
{
    protected $fileUploadRepository;

    /**
     * Inject the repository dependency.
     */
    public function __construct(FileUploadRepositoryInterface $fileUploadRepository)
    {
        $this->fileUploadRepository = $fileUploadRepository;
    }

    /**
     * Handle the file upload with a random or custom file name and trigger the event.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @param  string $directory
     * @param  string|null $fileName
     * @return array File metadata
     */
    public function uploadFile($file)
    {
        $fileMetadata = $this->fileUploadRepository->upload($file);

        event(new FileUploaded($fileMetadata));

        return $fileMetadata;
    }

    /**
     * Handle the file upload with a random or custom file name and trigger the event.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @param  string $directory
     * @param  string|null $fileName
     * @return array File metadata
     */
    public function deleteFile($file)
    {
        $fileDelete = $this->fileUploadRepository->delete($file);

        // event(new FileDelete($fileDelete));

        return $fileDelete;
    }
}
