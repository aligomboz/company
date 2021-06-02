<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'email' => 'required|email|unique:clients,email,' . $this->id,
            'phone' => 'required|min:10|max:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'AccessMethods'=>'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
        ];
    }
}
