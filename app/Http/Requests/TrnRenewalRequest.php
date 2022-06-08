<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrnRenewalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // 'trn_no' => [
            //     'required',
            //     Rule::unique('trn_renewal')->ignore($this->trn_id),
            //     new DocumentFormat()
            // ],
            'asset_child_id' => 'required',
            'trn_start_date' => 'required|date',
            'trn_date' => 'required|date',
            'trn_value_plan' => 'nullable',
            'trn_value' => 'required',
            'renewal_id' =>  'required',
            'pemohon' => 'required',
            'penyetuju' => 'required',
        ];
    }
}
