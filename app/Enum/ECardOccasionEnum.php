<?php

namespace App\Enum;

enum ECardOccasionEnum: string
{
    case BIRTHDAY = 'birthday';
    case CHRISTMAS = 'christmas';
    case EASTER = 'easter';
    case VALENTINES = 'valentines';
    case HALLOWEEN = 'halloween';

    public function name(): string
    {
        return match ($this) {
            self::BIRTHDAY => 'Birthday',
            self::CHRISTMAS => 'Christmas',
            self::EASTER => 'Easter',
            self::VALENTINES => "Valentine's",
            self::HALLOWEEN => 'Halloween',
        };
    }

    public function prompt(): string
    {
        return match ($this) {
            self::BIRTHDAY => 'Create a festive and celebratory scene that would be perfect for a Birthday card. The background should be a cheerful blue palette.',
            self::CHRISTMAS => 'Create a festive and cheerful scene that would be perfect for a Christmas card. The background should be a white and snowy color palette.',
            self::EASTER => 'Create a joyful scene that would be perfect for an Easter card. The background should be a bright and cheerful pastel color palette.',
            self::VALENTINES => "Create a romantic scene that would be perfect for a Valentine's card. The background should be a warm orange and pink color palette.",
            self::HALLOWEEN => 'Create a spooky scene that would be perfect for a Halloween card. The background should be a dark and eerie color palette.'
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

    public static function list(): array
    {
        return collect(self::cases())->mapWithKeys(fn (ECardOccasionEnum $cardOccasionEnum) => [$cardOccasionEnum->name() => $cardOccasionEnum->value])->toArray();
    }
}
