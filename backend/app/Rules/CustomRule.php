<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CustomRule implements Rule
{
    CONST REGEX_ALPHABET_SPACES = '/^[\pL\s]+$/u';

    /**
     * @param string $attribute
     * @param mixed $value
     * @return int
     */
    public function passes($attribute, $value)
    {
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute not passed validation.';
    }
}
