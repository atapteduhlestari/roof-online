<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SpecialCharacter implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $words = array('!', '@', '#', '<', '>', '?', '*', '$', '%', '^');

        foreach ($words as $word) {
            if (str_contains($value, $word))
                return false;
        }

        return true;
    }

    public function message()
    {
        return 'The :attribute must not contain special characters';
    }
}
