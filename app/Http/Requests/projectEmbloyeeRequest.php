<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class projectEmbloyeeRequest extends FormRequest
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
            'project_id' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'embloyee_id'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'type_job'=>'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
        ];
    }
}
