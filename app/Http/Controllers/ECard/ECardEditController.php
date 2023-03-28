<?php

namespace App\Http\Controllers\ECard;

use App\Actions\RemoveTemporaryFilesAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ECardEditController extends Controller
{
    public function create(string $name)
    {
        $user = request()->user();
        $images = request()->session()->get('images');

        $key = $images->search(function ($image) use ($name) {
            return $image['fileName'] === $name;
        });
        $chosenImage = $images[$key];

        $temporaryFilesBaseUrl = '/' . $user->id . '/e-cards/temporary/';
        $temporaryThumbnailBaseUrl = '/' . $user->id . '/e-cards/thumbnails/temporary';

        $oldFilePath = $temporaryFilesBaseUrl . $name;
        $newFilePath = '/' . $user->id . '/e-cards/' . $name;

        (new RemoveTemporaryFilesAction())->execute($oldFilePath, $newFilePath, $temporaryFilesBaseUrl, $temporaryThumbnailBaseUrl);

        $imageUrl = Storage::url($newFilePath);

        request()->session()->forget('images');

        return collect([
            'image_url' => $imageUrl,
            'header' => $chosenImage['header'],
            'message' => $chosenImage['message'],
            'font_colour' => $chosenImage['fontColour'],
        ]);
    }
}
