<?php

namespace App\Enum;

enum ECardOccasionEnum: string
{
    case BIRTHDAY = 'birthday';
    case CHRISTMAS = 'christmas';
    case EASTER = 'easter';
    case VALENTINES = 'valentines';
    case HALLOWEEN = 'halloween';

    public function prompt(): string
    {
        return match ($this) {
            self::BIRTHDAY => 'Create a festive and celebratory scene that would be perfect for a Birthday card. The background should be a cheerful blue palette.',
            self::CHRISTMAS => 'Create a festive and cheerful scene that would be perfect for a Christmas card. The background should be a white and snowy color palette.',
            self::EASTER => 'Create a joyful scene that would be perfect for an Easter card. The background should be a bright and cheerful pastel color palette.',
            self::VALENTINES => "Create a romantic scene that would be perfect for a Valentine's card. The background should be a warm orange and pink color palette.",
            self::HALLOWEEN => 'Create a spooky scene that would be perfect for a Halloween card. The overall color scheme should be dark and eerie, with shades of purple, black and orange.'
        };
    }

    public function fontColour(): string
    {
        return match ($this) {
            self::VALENTINES => '#000000',
            self::BIRTHDAY, self::CHRISTMAS => '#212121',
            self::EASTER => '#616161',
            self::HALLOWEEN => '#BDBDBD',
        };
    }
}
