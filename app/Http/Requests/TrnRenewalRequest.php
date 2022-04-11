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
            'asset_id' => 'required',
            'renewal_id' => 'required',
            'check' => 'required|boolean',
        ];

        if (TrnRenewalRequest::isMethod('PUT')) {
            $validate['asset_id'] = '';
            $validate['renewal_id'] = '';
            $validate['check'] = '';
        }

        return [
            // 'trn_no' => [
            //     'required',
            //     Rule::unique('trn_renewal')->ignore($this->trn_id),
            //     new DocumentFormat()
            // ],
            'trn_date' => 'required',
            'asset_id' => $validate['asset_id'],
            'renewal_id' =>  $validate['renewal_id'],
            'pelaksana' => 'required',
            'penyetuju' => 'required',
            'check' =>  $validate['check'],
        ];
    }
}
