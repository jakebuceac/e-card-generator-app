<?php

namespace App\Http\Requests\ECard;

use App\Enum\ECardOccasionEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ECardStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'occasion' => [new Enum(ECardOccasionEnum::class), 'required'],
            'header' => 'required|string|max:255',
            'message' => 'required|string|max:255',
            'font_colour' => 'required|string|max:255',
        ];
    }
}
