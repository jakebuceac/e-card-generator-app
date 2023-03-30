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
            self::SMALL => 10,
            self::MEDIUM => 20,
            self::LARGE => 50,
        };
    }

    public function editorHeaderSize(): int
    {
        return match ($this) {
            self::SMALL => 9,
            self::MEDIUM => 14,
            self::LARGE => 16,
        };
    }

    public function editorMessageSize(): int
    {
        return match ($this) {
            self::SMALL => 7,
            self::MEDIUM => 11,
            self::LARGE => 13,
        };
    }

    public function editorHeaderCoordinates(): string
    {
        return match ($this) {
            self::SMALL => '"x":-0.09251644736853226,"y":5.58411520633958,',
            self::MEDIUM => '"x":-1.329350645239796,"y":1.7013801028992688,',
            self::LARGE => '"x":-1.329350645238964,"y":2.9275085751215024,',
        };
    }

    public function editorMessageCoordinates(): string
    {
        return match ($this) {
            self::SMALL => '"x":3.4765624999997087,"y":141.52343749999946,',
            self::MEDIUM => '"x":-2.233758223684056,"y":185.90820312499235,',
            self::LARGE => '"x":-3.459886695904057,"y":210.43077256943783,',
        };
    }

    public function editorHeaderDimensions(): string
    {
        return match ($this) {
            self::SMALL => '"width":155.89226973684217,"height":13.925781249999996,',
            self::MEDIUM => '"width":211.4124177631501,"height":13.925781249998726,',
            self::LARGE => '"width":229.8043448464839,"height":13.925781249998709,',
        };
    }

    public function editorMessageDimensions(): string
    {
        return match ($this) {
            self::SMALL => '"width":153.1835937499998,"height":10.29296875000012,',
            self::MEDIUM => '"width":205.0956003289442,"height":10.292968749999616,',
            self::LARGE => '"width":232.21444479370172,"height":15.469981477999998,',
        };
    }

    public static function list(): array
    {
        return collect(self::cases())->mapWithKeys(fn (ECardSizeEnum $cardSizeEnum) => [$cardSizeEnum->name() . ' (' . $cardSizeEnum->value . ')' => $cardSizeEnum->value])->toArray();
    }
}
