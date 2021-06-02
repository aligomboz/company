<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'name' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            'email' => 'required|email|unique:employees,email,'.$this->id,
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10,'.$this->id,
            'start_job'=>'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            'end_job'=>'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            'contract'=>'required',
            'sallary'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'description'=>'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
        ];
    }
}
