<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrnStorageRequest extends FormRequest
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
        $validate = [
            'asset_id' => 'required',
            'storage_id' => 'required',
            'check' => 'required|boolean',
        ];

        if (TrnStorageRequest::isMethod('PUT')) {
            $validate['asset_id'] = '';
            $validate['storage_id'] = '';
            $validate['check'] = '';
        }

        return [
            // 'trn_no' => [
            //     'required',
            //     Rule::unique('trn_renewal')->ignore($this->trn_id),
            //     new DocumentFormat()
            // ],
            'trn_date' => 'required|date',
            'asset_id' => $validate['asset_id'],
            'storage_id' =>  $validate['storage_id'],
            'pelaksana' => 'required',
            'penyetuju' => 'required',
            'check' =>  $validate['check'],
        ];
    }
}
