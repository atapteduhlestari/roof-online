<?php

namespace App\Http\Requests;

use App\Rules\SpecialCharacter;
use Illuminate\Foundation\Http\FormRequest;

class AssetRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'asset_group_id' => 'required',
            'sdb_id' => 'nullable',
            'sbu_id' => 'nullable',
            'emp_id' => 'nullable',
            'asset_code' => 'required',
            'asset_no' => 'nullable',
            'asset_name' => ['required', new SpecialCharacter],
            'pcs_date' => 'required|date',
            'pcs_value' => 'required',
            'nilai_buku' => 'nullable',
            'apr_date' => 'nullable|date',
            'apr_value' => 'nullable',
            'location' => 'nullable',
            'condition' => 'required',
            'aktiva' => 'required',
            'image' => 'nullable|file|max:5120',
            'desc' => 'nullable'
        ];
    }
}
