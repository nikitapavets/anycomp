<?php

namespace App\Http\Requests;

use App\Providers\ResponseServiceProvider;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class Request extends FormRequest
{
    CONST REGEX_ALPHABET_SPACES = '/^[\pL\s]+$/u';
    // Minimum eight characters, at least one letter and one number
    CONST REGEX_PASSWORD = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';
    // Minimum eight characters, at least one uppercase letter, one lowercase letter and one number
    CONST REGEX_HIGH_PASSWORD = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/';
    // Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character
    CONST REGEX_COMPLEX_PASSWORD = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}/';
    CONST REGEX_MOBILE_PHONE = '/\+?\(?\d{2,4}\)?[\d\s-]{3,}/';

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), ResponseServiceProvider::HTTP_RESPONSE_BAD_REQUEST));
    }

    public function messages()
    {
        return [
            'password.regex' => 'Minimum eight characters, at least one letter and one number.'
        ];
    }
}