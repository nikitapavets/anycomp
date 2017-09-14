<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class RegistrationRequest extends Request
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
            'email' => 'required|email|max:255|unique:users,email',
            'first_name' => 'required|string|alpha|max:255',
            'last_name' => 'required|string|alpha|max:255',
            'password' => 'required|string|regex:' . self::REGEX_PASSWORD,
        ];
    }
}
