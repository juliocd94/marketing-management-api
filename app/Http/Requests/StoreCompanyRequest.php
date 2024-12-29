<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'planId' => 'required|int',
            'name' => 'required|string'
        ];
    }

    /**
     * Customize the error messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'planId.required' => 'El ID del plan es requerido',
            'planId.int' => 'El ID del plan debe ser un numero entero',
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser un string'
        ];
    }
}
