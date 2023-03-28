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
     * @param string $temporaryFilesBaseUrl
     * @param string $temporaryThumbnailsBaseUrl
     * @return void
     */
    public function execute(string $oldFilePath, string $newFilePath, string $temporaryFilesBaseUrl, string $temporaryThumbnailsBaseUrl): void
    {
        Storage::move($oldFilePath, $newFilePath);

        $usersTemporaryFiles = Storage::allFiles($temporaryFilesBaseUrl);
        $usersTemporaryThumbnails = Storage::allFiles($temporaryThumbnailsBaseUrl);

        Storage::delete($usersTemporaryFiles);
        Storage::delete($usersTemporaryThumbnails);
    }
}
