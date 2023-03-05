<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePersonaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'dni_persona'=>'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'celular'=>'required|max:9',
            'direccion'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'dni_persona.required' => 'El campo DNI es requerido.',
            'nombres.required' => 'El campo NOMBRES es requerido.',
            'apellidos.required' => 'El campo APELLIDOS es requerido.',
            'celular.required' => 'El campo CELULAR es requerido.',
            'direccion.required' => 'El campo DIRECCIÓN es requerido.'
        ];
    }
}
