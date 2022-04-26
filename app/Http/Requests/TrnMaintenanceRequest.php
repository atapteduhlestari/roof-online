<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrnMaintenanceRequest extends FormRequest
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
            // 'trn_no' => [
            //     'required',
            //     Rule::unique('trn_renewal')->ignore($this->trn_id),
            //     new DocumentFormat()
            // ],
            'trn_date' => 'required|date',
            'asset_id' => 'required',
            'maintenance_id' => 'required',
            'pemohon' => 'required',
            'penyetuju' => 'required'
        ];
    }
}
