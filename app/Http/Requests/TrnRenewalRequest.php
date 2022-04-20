<?php

namespace App\Http\Requests;

// use App\Rules\DocumentFormat;
use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Validation\Rule;

class TrnRenewalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $validate = [
            'asset_child_id' => 'required',
            'renewal_id' => 'required',
        ];

        if (TrnRenewalRequest::isMethod('PUT')) {
            $validate['asset_child_id'] = '';
            $validate['renewal_id'] = '';
        }

        return [
            // 'trn_no' => [
            //     'required',
            //     Rule::unique('trn_renewal')->ignore($this->trn_id),
            //     new DocumentFormat()
            // ],
            'asset_child_id' => $validate['asset_child_id'],
            'trn_date' => 'required|date',
            'renewal_id' =>  $validate['renewal_id'],
            'pemohon' => 'required',
            'penyetuju' => 'required',
            'trn_desc' => 'required'
        ];
    }
}
