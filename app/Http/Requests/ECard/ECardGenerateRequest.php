<?php

namespace App\Http\Requests\ECard;

use App\Enum\ECardOccasionEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ECardGenerateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'recipient_name' => 'required|string|max:20',
            'occasion' => [new Enum(ECardOccasionEnum::class), 'required'],
            'additional_prompt_details' => 'string|max:255',
            'personal_message' => 'string|max:37',
        ];
    }
}
