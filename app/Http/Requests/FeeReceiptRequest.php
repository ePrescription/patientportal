<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FeeReceiptRequest extends BasePrescriptionRequest
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
        $rules = [];

        $rules['patientId'] = 'required';
        $rules['hospitalId'] = 'required';
        $rules['doctorId'] = 'required';
        $rules['fees'] = 'required | numeric';

        return $rules;
    }
}
