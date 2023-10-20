<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitorRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'entity' => 'required|in:Persona natural,Persona jurídica',
            'dni' => 'bail|nullable|required_if:entity,Persona natural|numeric|digits:8|unique:visitors,dni',
            'ruc' => 'bail|nullable|required_if:entity,Persona jurídica|numeric|digits:11',
            'phone_number' => 'nullable|regex:/^(\+[0-9]{2} )?[0-9]{3}\s?[0-9]{3}\s?[0-9]{3}$/|unique:visitors,phone_number',
            'email' => 'nullable|email|max:255|unique:visitors,email'
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'El campo es obligatorio.',
            '*.required_if' => 'El campo es obligatorio.',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'entity' => 'entidad',
            'dni' => 'DNI',
            'phone_number' => 'número de celular',
            'email' => 'correo electrónico'
        ];
    }
}
