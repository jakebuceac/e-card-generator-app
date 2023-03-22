<?php

namespace App\Http\Controllers;

use App\Actions\CompileECardsAction;
use App\Http\Requests\ECard\ECardGenerateRequest;
use App\Models\PersonalMessage;
use App\Services\OpenAiApiService;

class ECardController extends Controller
{
    public function generate(ECardGenerateRequest $request)
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
