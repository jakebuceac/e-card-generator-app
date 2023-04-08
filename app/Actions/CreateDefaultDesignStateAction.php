<?php

namespace App\Actions;

use App\Enum\ECardOccasionEnum;
use App\Enum\ECardSizeEnum;

class CreateDefaultDesignStateAction
{
    /**
     * Creates the json string that can passed into image editor.
     *
     * @param string $imageUrl
     * @param string $header
     * @param string $message
     * @param string $occasion
     * @param string $size
     * @return string
     */
    public function execute(string $imageUrl, string $header, string $message, string $occasion, string $size): string
    {
        return '{
           "filter":null,
           "imgSrc": "' . $imageUrl. '",
           "resize":{
              "width":' . ECardSizeEnum::from($size)->number() . ',
              "height":'. ECardSizeEnum::from($size)->number() .',
              "manualChangeDisabled":false
           },
           "finetunes":[

           ],
           "adjustments":{
              "crop":{
                 "x":0,
                 "y":0,
                 "ratio":"original",
                 "width":null,
                 "height":null,
                 "ratioTitleKey":"original"
              },
              "rotation":0,
              "isFlippedX":false,
              "isFlippedY":false
           },
           "annotations":{
              "Text-940648460341":{'. ECardSizeEnum::from($size)->editorHeaderCoordinates() . '
                 "id":"Text-940648460341",
                 "fill":"' . ECardOccasionEnum::from($occasion)->fontColour() . '",
                 "name":"Text",
                 "text":"' . $header . '",
                 "align":"center",' . ECardSizeEnum::from($size)->editorHeaderDimensions() . '
                 "scaleX":1,
                 "scaleY":1,
                 "stroke":"#000000",
                 "opacity":1,
                 "fontSize":'. ECardSizeEnum::from($size)->editorHeaderSize() . ',
                 "rotation":0,
                 "fontStyle":"normal",
                 "fontFamily":"Lobster",
                 "lineHeight":1,
                 "shadowBlur":0,
                 "shadowColor":"#000000",
                 "strokeWidth":0,
                 "letterSpacing":0,
                 "shadowOffsetX":0,
                 "shadowOffsetY":0,
                 "shadowOpacity":1
              },
              "Text-1019469060237":{'. ECardSizeEnum::from($size)->editorMessageCoordinates() . '
                 "id":"Text-1019469060237",
                 "fill":"' . ECardOccasionEnum::from($occasion)->fontColour() . '",
                 "name":"Text",
                 "text":"' . $message . '",
                 "align":"center",' . ECardSizeEnum::from($size)->editorMessageDimensions() . '
                 "scaleX":1,
                 "scaleY":1,
                 "stroke":"#000000",
                 "opacity":1,
                 "fontSize":'. ECardSizeEnum::from($size)->editorMessageSize() . ',
                 "rotation":0,
                 "fontStyle":"normal",
                 "fontFamily":"Lobster",
                 "lineHeight":1,
                 "shadowBlur":0,
                 "shadowColor":"#000000",
                 "strokeWidth":0,
                 "letterSpacing":0,
                 "shadowOffsetX":0,
                 "shadowOffsetY":0,
                 "shadowOpacity":1
              }
           },
           "finetunesProps":[

           ],
           "shownImageDimensions":{
              "width":154.68749999999997,
              "height":154.68749999999997,
              "scaledBy":1
           }
        }';
    }
}
