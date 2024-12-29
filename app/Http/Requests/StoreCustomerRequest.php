<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'customerName' => 'required|string',
            'customerPhone' => 'required|string',
            'customerAddress' => 'required|string',
            'customerIdentification' => 'required|string'
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
            'customerName.required' => 'El nombre del cliente es obligatorio.',
            'customerPhone.required' => 'El teléfono del cliente es obligatorio.',
            'customerAddress.required' => 'La dirección del cliente es obligatoria.',
            'customerIdentification.required' => 'El número de identificación del cliente es obligatorio.',
        ];
    }
}
