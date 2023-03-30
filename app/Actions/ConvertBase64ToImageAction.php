<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ConvertBase64ToImageAction
{
    /**
     * Convert the base64 string given from the image editor to a valid image url to download.
     *
     * @param string $imageBase64
     * @param User $user
     * @param string $filename
     * @return string
     */
    public function execute(string $imageBase64, User $user, string $filename): string
    {
        $img = Image::make($imageBase64);

        $thumbnailPath = '/' . $user->id . '/e-cards/thumbnails/' . uniqid() . $filename;

        Storage::put($thumbnailPath, $img->stream());

        return Storage::url($thumbnailPath);
    }
}
