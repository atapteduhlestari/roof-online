<?php

namespace App\Http\Requests;

use App\Rules\SpecialCharacter;
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
            'doc_name' => ['required', new SpecialCharacter],
            'doc_code' => 'required',
            'doc_no' => 'nullable',
            'sbu_id' => 'required',
            'sdb_id' => 'nullable',
            'asset_id' => 'nullable',
            'document_id' => 'required',
            'file' => 'nullable|file|max:5120',
            'desc' => 'nullable'
        ];
    }
}
