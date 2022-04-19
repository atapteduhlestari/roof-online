<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetRequest extends FormRequest
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
            'asset_group_id' => 'required',
            'emp_id' => 'required',
            'asset_code' => 'required',
            'asset_no' => 'nullable',
            'asset_name' => 'required',
            'position' => 'required',
            'pcs_date' => 'required|date',
            'pcs_value' => 'required',
            'apr_date' => 'nullable|date',
            'apr_value' => 'nullable',
            'desc' => 'required',
            'image' => 'nullable',
        ];
    }
}
