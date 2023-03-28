<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;

class RemoveTemporaryFilesAction
{
    /**
     * Remove temporary files from storage bucket.
     *
     * @param string $oldFilePath
     * @param string $newFilePath
     * @param string $oldThumbnailPath
     * @param string $newThumbnailPath
     * @param string $temporaryFilesBaseUrl
     * @param string $temporaryThumbnailsBaseUrl
     * @return void
     */
    public function execute(string $oldFilePath, string $newFilePath, string $oldThumbnailPath, string $newThumbnailPath, string $temporaryFilesBaseUrl, string $temporaryThumbnailsBaseUrl): void
    {
        Storage::move($oldFilePath, $newFilePath);
        Storage::move($oldThumbnailPath, $newThumbnailPath);

        $usersTemporaryFiles = Storage::allFiles($temporaryFilesBaseUrl);
        $usersTemporaryThumbnails = Storage::allFiles($temporaryThumbnailsBaseUrl);

        Storage::delete($usersTemporaryFiles);
        Storage::delete($usersTemporaryThumbnails);
    }
}
