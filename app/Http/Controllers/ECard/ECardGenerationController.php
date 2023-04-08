<?php

namespace App\Http\Controllers\ECard;

use App\Actions\CompileECardsAction;
use App\Enum\ECardOccasionEnum;
use App\Enum\ECardSizeEnum;
use App\Exceptions\OpenAiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ECard\ECardGenerateRequest;
use App\Models\PersonalMessage;
use App\Services\OpenAiApiService;
use Inertia\Inertia;
use Inertia\Response;

class ECardGenerationController extends Controller
{
    /**
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('ECard/Generate/GenerateForm', [
            'image_sizes' => ECardSizeEnum::list(),
            'occasions' => ECardOccasionEnum::list(),
        ]);
    }

    /**
     * @param ECardGenerateRequest $request
     * @return Response
     * @throws OpenAiException
     */
    public function store(ECardGenerateRequest $request): Response
    {
        $user = $request->user();
        $openaiApiService = new OpenAiApiService();
        $personalMessages = PersonalMessage::byOccasion($request->occasion)
            ->inRandomOrder()
            ->limit(6)
            ->get();

        $generatedImages = $openaiApiService->generateImages($request->occasion, $request->additional_prompt_details);

        $images = (new CompileECardsAction())->execute(
            $user,
            $generatedImages,
            $request->occasion,
            '512x512',
            $request->recipient_name,
            $personalMessages,
            $request->personal_message,
        );

        return Inertia::render('ECard/Generate/ShowNewECards', [
            'images' => $images,
        ]);
    }
}
