<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRifaRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'string',
            'quantityTickets' => 'required|int',
            'currency' => 'required|string',
            'price' => 'required|numeric',
            'awards' => 'array',
            'initDate' => 'date',
            'finishDate' => 'date'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la rifa es requerido.',
            'quantityTickets.required' => 'La cantidad de tickets es requerida.',
            'quantityTickets.int' => 'La cantidad de tickets debe ser un número entero.',
            'price.required' => 'El precio del ticket es requerido.',
            'price.numeric' => 'El precio del ticket debe ser un número.',
            'awards.*.description.required' => 'La descripción del premio es requerida.',
            'awards.*.lottery.required' => 'El nombre de la lotería es requerido.',
            'awards.*.drawDate.required' => 'La fecha de sorteo del premio es requerida.',
        ];
    }
}
