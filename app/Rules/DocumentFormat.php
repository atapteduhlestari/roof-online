<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DocumentFormat implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        if (str_contains($value, '#'))
            return false;

        return true;
    }

    public function message()
    {
        return "Replace '#' with number";
    }
}
