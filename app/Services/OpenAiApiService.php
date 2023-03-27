<?php

namespace App\Services;

use App\Enum\ECardOccasionEnum;
use App\Exceptions\OpenAiException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class OpenAiApiService
{
    protected $httpClient = null;

    /**
     * Create a new OpenAiApiService instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (config('app.env') !== 'production') {
            $response = collect([
                'created' => now()->toDateTime(),
                'data' => [
                    [
                        'url' => base_path('tests/Stubs/Test_256x256.png'),
                    ],
                    [
                        'url' => base_path('tests/Stubs/Test_256x256.png'),
                    ],
                    [
                        'url' => base_path('tests/Stubs/Test_256x256.png'),
                    ],
                    [
                        'url' => base_path('tests/Stubs/Test_256x256.png'),
                    ],
                    [
                        'url' => base_path('tests/Stubs/Test_256x256.png'),
                    ],
                    [
                        'url' => base_path('tests/Stubs/Test_256x256.png'),
                    ],
                ],
            ]);

            $this->httpClient = Http::fake([
                '/images/generations' => Http::response($response),
            ])->baseUrl(config('services.openai_api.url'));
        } else {
            $this->httpClient = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . config('services.openai_api.secret_key'),
            ])->baseUrl(config('services.openai_api.url'));
        }
    }

    /**
     * Get generated images.
     *
     * @param string $occasion
     * @param string $imageSize
     * @param string|null $additionalPromptDetails
     * @return Collection
     * @throws OpenAiException
     */
    public function generateImages(string $occasion, string $imageSize, string $additionalPromptDetails = null): Collection
    {
        $prompt = $additionalPromptDetails ? ECardOccasionEnum::from($occasion)->prompt() . ' ' . $additionalPromptDetails : ECardOccasionEnum::from($occasion)->prompt();
        $response = $this->httpClient
            ->post('/images/generations', [
                'prompt' => $prompt,
                'n' => 6,
                'size' => $imageSize,
            ]);

        if ($response->failed()) {
            throw OpenAiException::couldNotGetGeneratedImages();
        }

        return $response->collect('data');
    }
}
