<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitRequest extends FormRequest
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
            'subject' => 'required|string|max:255',
            // 'start_date' => 'required|date|before:end_date',
            // 'end_date' => 'required|date|after:start_date',
            'date' => 'required',
            'start_hour' => 'required|date_format:H:i',
            'status' => 'nullable|in:Pendiente,Confirmado,Cancelado',
            'visitor_id' => 'required|exists:visitors,id',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    public function attributes()
    {
        return [
            'subject' => 'asunto',
            'start_date' => 'fecha de inicio',
            'end_date' => 'fecha de finalización',
            'status' => 'estado',
            'visitor_id' => 'visitante',
            'user_id' => 'user'
        ];
    }

    public function messages()
    {
        return [
            'visitor_id.exists' => 'Seleccione un visitante.',
            'start_hour.date_format' => 'El rango seleccionado no es válido.',
            'start_hour.required' => 'Seleccione un rango de horas.',
            'date.date' => 'La fecha seleccionada no es válida.',
            'date.required' => 'Seleccione una fecha.',
        ];
    }
}
