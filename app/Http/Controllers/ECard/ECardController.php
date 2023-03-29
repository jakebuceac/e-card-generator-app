<?php

namespace App\Http\Controllers\ECard;

use App\Actions\CreateDefaultDesignStateAction;
use App\Actions\RemoveTemporaryFilesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ECard\ECardStoreRequest;
use App\Models\ECard;
use App\Models\ECardInformation;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ECardController extends Controller
{
    /**
     * @param int $eCardInformationId
     * @return Response
     * @throws AuthorizationException
     */
    public function create(int $eCardInformationId): Response
    {
        $eCardInformation = ECardInformation::findOrFail($eCardInformationId);

        $this->authorize('update', $eCardInformation);

        return Inertia::render('ECard/Edit', [
            'id' => $eCardInformation->id,
            'image_url' => $eCardInformation->image_url,
            'design_state' => json_decode($eCardInformation->assets),
        ]);
    }

    public function store(ECardStoreRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
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

        $assets = (new CreateDefaultDesignStateAction())->execute(
            $imageUrl,
            $request->header,
            $request->message,
            $request->occasion,
            $request->image_size,
        );

        $eCard = $user->eCards()->save(
            new ECard([
                'name' => $request->name,
                'thumbnail_url' => Storage::url($thumbnailPath),
                'size' => $request->image_size,
                'occasion' => $request->occasion,
            ])
        );

        $eCardInformation = $eCard->eCardInformation()->save(
            new ECardInformation([
                'image_url' => $imageUrl,
                'assets' => $assets,
            ])
        );

        return redirect('/e-card/' . $eCardInformation->id);
    }

    public function update(Request $request, int $eCardInformationId): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $eCardInformation = ECardInformation::findOrFail($eCardInformationId);

        $eCardInformation->assets = $request->design_state;
        $eCardInformation->save();

        return redirect('/e-card/' . $eCardInformation->id);
    }
}
