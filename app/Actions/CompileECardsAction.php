<?php

namespace App\Actions;

use App\Enum\ECardOccasionEnum;
use App\Enum\ECardSizeEnum;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CompileECardsAction
{
    /**
     * Add personalised message to images.
     *
     * @param User $user
     * @param Collection $urls
     * @param string $occasion
     * @param string $imageSize
     * @param string $recipientName
     * @param Collection $personalMessages
     * @param string|null $usersMessage
     * @return Collection
     */
    public function execute(User $user, Collection $urls, string $occasion, string $imageSize, string $recipientName, Collection $personalMessages, string $usersMessage = null): Collection
    {
        return $urls->map(function ($item, $key) use ($user, $occasion, $recipientName, $imageSize, $usersMessage, $personalMessages) {
            $baseUrl = '/' . $user->id;
            $fileName = date('Y-m-dH:i:s') . uniqid() . '.png';
            $temporaryFilePath = $baseUrl . '/e-cards/temporary/' . $fileName;

            $header = preg_replace('/xxx/i', $recipientName, $personalMessages[$key]['header']);
            $message = $usersMessage ?? preg_replace('/xxx/i', $recipientName, $personalMessages[$key]['message']);

            $img = Image::make(file_get_contents($item['url']));

            $xCoordinate = ECardSizeEnum::from($imageSize)->number() / 2;
            $yCoordinate = ECardSizeEnum::from($imageSize)->number() - 8;

            $headerFontSize = ECardSizeEnum::from($imageSize)->headerFontSize();
            $messageFontSize = ECardSizeEnum::from($imageSize)->messageFontSize();

            $fontColour = ECardOccasionEnum::from($occasion)->fontColour();

            Storage::put($temporaryFilePath, file_get_contents($item['url']));

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

            $temporaryThumbnailPath = $baseUrl . '/e-cards/thumbnails/temporary/' . $fileName;

            Storage::put($temporaryThumbnailPath, $img->stream());

            return [
                'name' => $fileName,
                'thumbnail_url' => Storage::url($temporaryThumbnailPath),
                'occasion' => $occasion,
                'header' => $header,
                'message' => $message,
                'font_colour' => $fontColour,
            ];
        });
    }
}
