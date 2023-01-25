<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetChildRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'doc_name' => 'required',
            'doc_no' => 'nullable',
            'sbu_id' => 'required',
            'sdb_id' => 'nullable',
            'file' => 'nullable|file|max:5120',
            'desc' => 'nullable'
        ];
    }
}
