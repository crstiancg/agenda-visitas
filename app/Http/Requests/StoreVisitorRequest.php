<?php

namespace App\Http\Requests;

use App\Models\Visitor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
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
    public function rules(Request $request)
    {
        // return [
        //     'dni' => 'bail|nullable|required_if:entity,Persona natural|numeric|digits:8|' . Rule::unique('visitors', 'dni')->ignore($this->route('visitor')),
        //     'name' => 'required|string|max:255',
        //     'entity' => 'required|in:Persona natural,Persona jurídica',
        //     'ruc' => 'bail|nullable|required_if:entity,Persona jurídica|numeric|digits:11',
        //     'phone_number' => 'bail|nullable|numeric|digits:9|' . Rule::unique('visitors', 'phone_number')->ignore($this->route('visitor')),
        //     'email' =>  ['required', Rule::unique('visitors', 'email')->ignore($this->visitor)]

        // ];
        return [
            'dni' => 'bail|nullable|required_if:entity,Persona natural|numeric|digits:8|',
            'name' => 'required',
            'entity' => 'required',
            'ruc' => 'bail|nullable|required_if:entity,Persona jurídica|numeric|digits:11',
            'phone_number' => 'bail|nullable|numeric|digits:9|',
            'email' =>  'required',
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
