<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OrderUserRequest extends Request
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
            'client_first_name' => 'bail|required',
            'client_second_name' => 'bail|required',
            'client_father_name' => 'bail|required',
            'client_mobile_phone' => 'bail|required|phone',
            'client_email' => 'bail|required|email|unique:clients,email',
        ];
    }
}
