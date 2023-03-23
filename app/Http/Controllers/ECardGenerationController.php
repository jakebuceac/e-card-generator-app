<?php

namespace App\Http\Controllers;

use App\Actions\CompileECardsAction;
use App\Enum\ECardOccasionEnum;
use App\Enum\ECardSizeEnum;
use App\Http\Requests\ECard\ECardGenerateRequest;
use App\Models\PersonalMessage;
use App\Services\OpenAiApiService;
use Inertia\Inertia;
use Inertia\Response;

class ECardGenerationController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('E-Card/Generate', [
            'image_sizes' => ECardSizeEnum::list(),
            'occasions' => ECardOccasionEnum::list(),
        ]);
    }

    public function store(ECardGenerateRequest $request)
    {
        $openaiApiService = new OpenAiApiService();
        $personalMessages = PersonalMessage::byOccasion($request->occasion)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        $generatedImages = $openaiApiService->generateImages($request->occasion, $request->image_size);

        return (new CompileECardsAction())->execute(
            $generatedImages,
            $request->occasion,
            $request->image_size,
            $request->recipient_name,
            $request->personal_message,
            $personalMessages
        );
    }
}
