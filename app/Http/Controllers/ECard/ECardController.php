<?php

namespace App\Http\Controllers\ECard;

use App\Actions\RemoveTemporaryFilesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ECard\ECardStoreRequest;
use App\Models\ECard;
use App\Models\ECardInformation;
use Illuminate\Support\Facades\Storage;

class ECardController extends Controller
{
    public function store(ECardStoreRequest $request)
    {
        $user = request()->user();

        $filePath = '/' . $user->id . '/e-cards/' . $request->name;
        $thumbnailPath = '/' . $user->id . '/e-cards/thumbnails/' . $request->name;

        $temporaryFilesBaseUrl = '/' . $user->id . '/e-cards/temporary/';
        $temporaryThumbnailBaseUrl = '/' . $user->id . '/e-cards/thumbnails/temporary/';

        $oldFilePath = $temporaryFilesBaseUrl . $request->name;
        $oldThumbnailPath = $temporaryThumbnailBaseUrl . $request->name;

        (new RemoveTemporaryFilesAction())->execute($oldFilePath, $filePath, $oldThumbnailPath, $thumbnailPath,  $temporaryFilesBaseUrl, $temporaryThumbnailBaseUrl);


        $imageUrl = Storage::url($filePath);

        $assets = collect([
            'header' => $request->header,
            'message' => $request->message,
            'font_colour' => $request->font_colour,
        ]);

        $eCard = $user->eCards()->save(
            new ECard([
                'name' => $request->name,
                'thumbnail_url' => Storage::url($thumbnailPath),
                'size' => Storage::size($filePath),
                'occasion' => $request->occasion,
            ])
        );

        $eCard->eCardInformation()->save(
            new ECardInformation([
                'image_url' => $imageUrl,
                'assets' => $assets,
            ])
        );

        return redirect('/e-card/edit/' . $request->name);
    }
}
