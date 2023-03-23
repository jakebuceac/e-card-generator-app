<?php

namespace App\Enum;

enum ECardSizeEnum: string
{
    case SMALL = '256x256';
    case MEDIUM = '512x512';
    case LARGE = '1024x1024';

    public function name(): string
    {
        return match ($this) {
            self::SMALL => 'Small',
            self::MEDIUM => 'Medium',
            self::LARGE => 'Large',
        };
    }

    public function number(): int
    {
        return match ($this) {
            self::SMALL => 256,
            self::MEDIUM => 512,
            self::LARGE => 1024,
        };
    }

    public function headerFontSize(): int
    {
        return match ($this) {
            self::SMALL => 14,
            self::MEDIUM => 24,
            self::LARGE => 54,
        };
    }

    public function messageFontSize(): int
    {
        return match ($this) {
            self::SMALL => 9,
            self::MEDIUM => 19,
            self::LARGE => 49,
        };
    }

    public static function list(): array
    {
        return collect(self::cases())->mapWithKeys(fn (ECardSizeEnum $cardSizeEnum) => [$cardSizeEnum->name() . ' (' . $cardSizeEnum->value . ')' => $cardSizeEnum->value])->toArray();
    }
}
