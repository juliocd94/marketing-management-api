<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'amount' => 'required|numeric|min:0',
            'referenceValue' => 'required|numeric|min:0',
            'date' => 'required|date',
            'currency' => 'required|string|max:10',
            'ticketId' => 'required|string|max:50',
            'paymentMethod' => 'required|string|max:50',
        ];
    }
}
