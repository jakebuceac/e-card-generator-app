<?php

namespace App\Http\Controllers\ECard;

use App\Actions\ConvertBase64ToImageAction;
use App\Actions\CreateDefaultDesignStateAction;
use App\Actions\RemoveTemporaryFilesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ECard\ECardStoreRequest;
use App\Http\Requests\ECard\ECardUpdateRequest;
use App\Http\Resources\ECardResource;
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
     * @param ECard $eCard
     * @return Response
     * @throws AuthorizationException
     */
    public function create(ECard $eCard): Response
    {
        $this->authorize('create', $eCard);

        return Inertia::render('ECard/Edit', [
            'e_card' => ECardResource::make($eCard),
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

        (new RemoveTemporaryFilesAction())->execute(
            $oldFilePath,
            $filePath,
            $oldThumbnailPath,
            $thumbnailPath,
            $temporaryFilesBaseUrl,
            $temporaryThumbnailBaseUrl
        );


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

    public function index(Request $request): Response
    {
        $user = $request->user();

        return $user->eCards()->exists() ?
            Inertia::render('ECard/Index', [
                'e_cards' => ECardResource::collection($user->eCards()->get()),
            ]) :
            Inertia::render('Dashboard');
    }

    public function update(ECardUpdateRequest $request, ECard $eCard): string
    {
        $user = $request->user();
        $eCardInformation = $eCard->eCardInformation;

        $eCardInformation->assets = $request->design_state;
        $eCardInformation->save();

        $url = (new ConvertBase64ToImageAction())->execute($request->image_base_64, $user, $request->filename);

        $eCard->name = $request->filename;
        $eCard->size = $request->size;
        $eCard->thumbnail_url = $url;
        $eCard->save();

        return $url;
    }
}
