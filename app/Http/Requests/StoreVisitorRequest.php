<?php

namespace App\Http\Requests;

use App\Models\Visitor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
            'dni' => 'bail|nullable|required_if:entity,Persona natural|numeric|digits:8|' . Rule::unique('visitors', 'dni')->ignore($this->route('visitor')),
            'ruc' => 'bail|nullable|required_if:entity,Persona jurídica|numeric|digits:11',
            'phone_number' => 'bail|nullable|numeric|digits:9|' . Rule::unique('visitors', 'phone_number')->ignore($this->route('visitor')),
            'email' => 'nullable|email|max:255'. Rule::unique('visitors', 'email')->ignore($this->route('visitor'))
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
