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
        $words = array('ATL', 'HOJ', 'SOP', 'GAN');

        if (str_contains($value, '#'))
            return false;

        foreach ($words as $word) {
            if (!str_contains($value, $word))
                return false;
        }

        return true;
    }

    public function message()
    {
        return 'False document format';
    }
}
