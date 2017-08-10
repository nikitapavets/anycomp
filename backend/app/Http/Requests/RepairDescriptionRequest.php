<?php

namespace App\Http\Requests;

class RepairDescriptionRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => 'max:255',
            'price' => 'numeric'
        ];
    }
}