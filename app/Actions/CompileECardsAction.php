<?php

namespace App\Actions;

use App\Enum\ECardOccasionEnum;
use App\Enum\ECardSizeEnum;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CompileECardsAction
{
    /**
     * Add personalised message to images.
     *
     * @param Collection $urls
     * @param string $occasion
     * @param string $imageSize
     * @param string $recipientName
     * @param string|null $usersMessage
     * @param $personalMessages
     * @return Collection
     */
    public function execute(Collection $urls, string $occasion, string $imageSize, string $recipientName, string $usersMessage = null, $personalMessages): Collection
    {
        return $urls->map(function ($item, $key) use ($occasion, $recipientName, $imageSize, $usersMessage, $personalMessages) {
            $temporaryFilePath = '/e-card/temporary/' . date('Y-m-dH:i:s') . uniqid() . '.png';

            $header = preg_replace('/xxx/i', $recipientName, $personalMessages[$key]['header']);
            $message = $usersMessage ?? preg_replace('/xxx/i', $recipientName, $personalMessages[$key]['message']);

            $img = Image::make(file_get_contents($item['url']));

            $xCoordinate = ECardSizeEnum::from($imageSize)->number() / 2;
            $yCoordinate = ECardSizeEnum::from($imageSize)->number() - 8;

            $headerFontSize = ECardSizeEnum::from($imageSize)->headerFontSize();
            $messageFontSize = ECardSizeEnum::from($imageSize)->messageFontSize();

            $fontColour = ECardOccasionEnum::from($occasion)->fontColour();

            Storage::put($temporaryFilePath, file_get_contents($item['url']), [
                'Metadata' => [
                    'Expiry' => now()->addHours(2)->toDateTimeString(),
                    'header' => $header,
                    'message' => $message,
                    'fontColour' => $fontColour,
                ],
            ]);

            $img->text($header, $xCoordinate, 10, function ($font) use ($fontColour, $headerFontSize) {
                $font->file(public_path('fonts/Fraset-Display.ttf'));
                $font->size($headerFontSize);
                $font->align('center');
                $font->valign('top');
                $font->color($fontColour);
            });

            $img->text($message, $xCoordinate, $yCoordinate, function ($font) use ($fontColour, $messageFontSize) {
                $font->file(public_path('fonts/Fraset-Display.ttf'));
                $font->size($messageFontSize);
                $font->align('center');
                $font->valign('bottom');
                $font->color($fontColour);
            });

            $img->resize(256, 256);

            $temporaryThumbnailPath = '/e-card/thumbnail/temporary/' . date('Y-m-dH:i:s') . uniqid() . '.png';

            Storage::put($temporaryThumbnailPath, $img->stream(), [
                'Metadata' => [
                    'Expiry' => now()->addHours(2)->toDateTimeString(),
                ],
            ]);

            $item['url'] = Storage::url($temporaryThumbnailPath);

            return $item;
        });
    }
}