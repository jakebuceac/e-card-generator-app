<?php

namespace App\Http\Requests\ECard;

use Illuminate\Foundation\Http\FormRequest;

class ECardUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $eCard = $this->route('eCard');

        return auth()->user()->can('update', $eCard);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'design_state' => 'required|string',
            'image_base_64' => 'string|required',
            'filename' => 'string|required',
            'size' => 'string|required',
        ];
    }
}
