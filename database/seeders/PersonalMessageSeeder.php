<?php

namespace Database\Seeders;

use App\Enum\ECardOccasionEnum;
use App\Models\PersonalMessage;
use Illuminate\Database\Seeder;

class PersonalMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Birthday messages
        PersonalMessage::insert([
            [
                'header' => 'Happy Birthday, XXX!',
                'message' => 'May your day be filled with lots of cake!',
                'occasion' => ECardOccasionEnum::BIRTHDAY->value,
            ],
            [
                'header' => "It's XXX's Birthday!",
                'message' => 'Hope your birthday is as amazing as you are!',
                'occasion' => ECardOccasionEnum::BIRTHDAY->value,
            ],
            [
                'header' => 'Happy Birthday to XXX!',
                'message' => 'Enjoy your special day!',
                'occasion' => ECardOccasionEnum::BIRTHDAY->value,
            ],
            [
                'header' => 'Happy Birthday!',
                'message' => 'Sending warm Birthday wishes to XXX!',
                'occasion' => ECardOccasionEnum::BIRTHDAY->value,
            ],
            [
                'header' => 'Happy Birthday, XXX!',
                'message' => 'Sending lots of Birthday love and hugs!',
                'occasion' => ECardOccasionEnum::BIRTHDAY->value,
            ],
            [
                'header' => 'Wishing XXX a great Birthday!',
                'message' => 'Sending lots of Birthday love and laughter!',
                'occasion' => ECardOccasionEnum::BIRTHDAY->value,
            ],
            [
                'header' => 'Another year older and wiser!',
                'message' => 'Hope you have a great Birthday XXX!',
                'occasion' => ECardOccasionEnum::BIRTHDAY->value,
            ],
            [
                'header' => 'To a fabulous year ahead!',
                'message' => 'Wishing XXX a great Birthday!',
                'occasion' => ECardOccasionEnum::BIRTHDAY->value,
            ],
            [
                'header' => "Hoping XXX's wishes come true!",
                'message' => 'Enjoy your special day!',
                'occasion' => ECardOccasionEnum::BIRTHDAY->value,
            ],
            [
                'header' => "It's XXX's Birthday!",
                'message' => 'Happy birthday and cheers to you!',
                'occasion' => ECardOccasionEnum::BIRTHDAY->value,
            ],
        ]);

        // Seed Christmas messages
        PersonalMessage::insert([
            [
                'header' => 'Merry Christmas, XXX!',
                'message' => 'Wishing you a joyous new year!',
                'occasion' => ECardOccasionEnum::CHRISTMAS->value,
            ],
            [
                'header' => 'Happy holidays, XXX!',
                'message' => 'May your Christmas be merry and bright',
                'occasion' => ECardOccasionEnum::CHRISTMAS->value,
            ],
            [
                'header' => 'Sending XXX warm wishes!',
                'message' => 'Warmest wishes to you and yours, XXX!',
                'occasion' => ECardOccasionEnum::CHRISTMAS->value,
            ],
            [
                'header' => 'Feliz Navidad, XXX!',
                'message' => "Here's to a magical holiday season!",
                'occasion' => ECardOccasionEnum::CHRISTMAS->value,
            ],
            [
                'header' => 'Merry Christmas, XXX!',
                'message' => 'May your Christmas be merry!',
                'occasion' => ECardOccasionEnum::CHRISTMAS->value,
            ],
            [
                'header' => 'Happy holidays, XXX!',
                'message' => 'May the magic of Christmas fill your heart!',
                'occasion' => ECardOccasionEnum::CHRISTMAS->value,
            ],
            [
                'header' => 'Sending XXX warm wishes!',
                'message' => 'Hope you have a wonderful Christmas!',
                'occasion' => ECardOccasionEnum::CHRISTMAS->value,
            ],
            [
                'header' => 'Merry Christmas, XXX!',
                'message' => 'Hoping your having a good holiday!',
                'occasion' => ECardOccasionEnum::CHRISTMAS->value,
            ],
            [
                'header' => 'Merry Christmas, XXX!',
                'message' => 'Sending you love, peace!',
                'occasion' => ECardOccasionEnum::CHRISTMAS->value,
            ],
            [
                'header' => 'Merry Christmas, XXX!',
                'message' => 'Wishing you have a joyful holiday!',
                'occasion' => ECardOccasionEnum::CHRISTMAS->value,
            ],
        ]);

        // Seed Easter messages
        PersonalMessage::insert([
            [
                'header' => 'Happy Easter, XXX!',
                'message' => 'Wishing you a happy new beginnings!',
                'occasion' => ECardOccasionEnum::EASTER->value,
            ],
            [
                'header' => 'Joyful Easter, XXX!',
                'message' => 'Hoping your Easter is as sweet as can be!',
                'occasion' => ECardOccasionEnum::EASTER->value,
            ],
            [
                'header' => 'Joyous Easter, XXX!',
                'message' => 'May your Easter be as colorful and bright!',
                'occasion' => ECardOccasionEnum::EASTER->value,
            ],
            [
                'header' => 'Glorious Easter, XXX!',
                'message' => 'May you be surrounded by love and warmth!',
                'occasion' => ECardOccasionEnum::EASTER->value,
            ],
            [
                'header' => 'Happy Easter, XXX!',
                'message' => 'Hope your Easter Sunday will be joyful!',
                'occasion' => ECardOccasionEnum::EASTER->value,
            ],
            [
                'header' => 'Glorious Easter, XXX!',
                'message' => 'Wishing a holiday filled with happiness!',
                'occasion' => ECardOccasionEnum::EASTER->value,
            ],
            [
                'header' => 'Joyous Easter, XXX!',
                'message' => 'May your day be bright and beautiful!',
                'occasion' => ECardOccasionEnum::EASTER->value,
            ],
            [
                'header' => 'Joyful Easter, XXX!',
                'message' => 'Hope you get a load of chocolate eggs!',
                'occasion' => ECardOccasionEnum::EASTER->value,
            ],
            [
                'header' => 'May the holiday bring you peace!',
                'message' => 'Blessed Easter, XXX!',
                'occasion' => ECardOccasionEnum::EASTER->value,
            ],
            [
                'header' => 'Hoppy Easter, XXX!',
                'message' => 'Have a wonderful Easter celebration!',
                'occasion' => ECardOccasionEnum::EASTER->value,
            ],
        ]);

        // Seed Valentines messages
        PersonalMessage::insert([
            [
                'header' => 'Making my every day brighter',
                'message' => 'XXX, you fill my heart with joy!',
                'occasion' => ECardOccasionEnum::VALENTINES->value,
            ],
            [
                'header' => 'Happy Valentines, XXX!',
                'message' => 'Love you more than words can say!',
                'occasion' => ECardOccasionEnum::VALENTINES->value,
            ],
            [
                'header' => 'To, XXX!',
                'message' => 'I am so lucky to have you in my life!',
                'occasion' => ECardOccasionEnum::VALENTINES->value,
            ],
            [
                'header' => 'Making my every day brighter!',
                'message' => 'Happy Valentines Day to you, XXX!',
                'occasion' => ECardOccasionEnum::VALENTINES->value,
            ],
            [
                'header' => 'To, XXX!',
                'message' => 'You make my heart skip a beat!',
                'occasion' => ECardOccasionEnum::VALENTINES->value,
            ],
            [
                'header' => 'Your my partner in crime, XXX!',
                'message' => 'Sending you my love and affection!',
                'occasion' => ECardOccasionEnum::VALENTINES->value,
            ],
            [
                'header' => "Happy Valentine's!",
                'message' => 'Your amazing, XXX',
                'occasion' => ECardOccasionEnum::VALENTINES->value,
            ],
            [
                'header' => 'Making my every day brighter',
                'message' => 'You light up my life, XXX',
                'occasion' => ECardOccasionEnum::VALENTINES->value,
            ],
            [
                'header' => 'To, XXX!',
                'message' => 'I cherish every moment we are together!',
                'occasion' => ECardOccasionEnum::VALENTINES->value,
            ],
            [
                'header' => 'Happy Valentines, XXX!',
                'message' => 'You complete me in every way!',
                'occasion' => ECardOccasionEnum::VALENTINES->value,
            ],
        ]);

        // Seed Halloween messages
        PersonalMessage::insert([
            [
                'header' => 'Happy Halloween, XXX!',
                'message' => 'Wishing you a day filled with thrills!',
                'occasion' => ECardOccasionEnum::HALLOWEEN->value,
            ],
            [
                'header' => 'Trick or treat, XXX!',
                'message' => 'Hope your Halloween is full of tricks/treats',
                'occasion' => ECardOccasionEnum::HALLOWEEN->value,
            ],
            [
                'header' => 'Happy Halloween, XXX!',
                'message' => 'Have a hauntingly good Halloween!',
                'occasion' => ECardOccasionEnum::HALLOWEEN->value,
            ],
            [
                'header' => 'Trick or treat, XXX!',
                'message' => 'Your my favorite ghoul-friend!',
                'occasion' => ECardOccasionEnum::HALLOWEEN->value,
            ],
            [
                'header' => 'To, XXX!',
                'message' => 'Wishing you a spooktacular Halloween!',
                'occasion' => ECardOccasionEnum::HALLOWEEN->value,
            ],
            [
                'header' => 'Dont be a scaredy-cat, XXX!',
                'message' => 'May your Halloween be filled with treats!',
                'occasion' => ECardOccasionEnum::HALLOWEEN->value,
            ],
            [
                'header' => 'Have a good Halloween, XXX!',
                'message' => 'Your my boo-tiful friend!',
                'occasion' => ECardOccasionEnum::HALLOWEEN->value,
            ],
            [
                'header' => 'Dont be a scaredy-cat, XXX!',
                'message' => 'Sending you ghostly greetings!',
                'occasion' => ECardOccasionEnum::HALLOWEEN->value,
            ],
            [
                'header' => 'Trick or treat, XXX!',
                'message' => 'Enjoy the frightful festivities!',
                'occasion' => ECardOccasionEnum::HALLOWEEN->value,
            ],
            [
                'header' => 'Happy Halloween, XXX!',
                'message' => 'Hope your night will be full of fun!',
                'occasion' => ECardOccasionEnum::HALLOWEEN->value,
            ],
        ]);
    }
}
