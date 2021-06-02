<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'start_date'=>'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            'end_date'=>'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            'client_id'=>'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            'requirements_name'=>'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            'price'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/',
        ];
    }
}
