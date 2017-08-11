<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SpareRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'organization_id' => 'required|numeric',
            'delivery_id' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric',
        ];
    }
}
