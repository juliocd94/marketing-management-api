<?php

namespace App\Http\Requests;

use App\Models\Customer;
use App\Models\Ticket;
use Cassandra\Custom;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterTicketSaleRequest extends FormRequest
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
            'customerId' => 'nullable|int|exists:customers,id',
            'customerName' => 'required_if:customerId,null|string',
            'customerPhone' => 'required_if:customerId,null|string',
            'customerAddress' => 'required_if:customerId,null|string',
            'customerIdentification' => 'required_if:customerId,null|string',
            'ticketId' => 'required|int|exists:tickets,id',
        ];
    }

    public function messages(): array
    {
        return [
            'customerId.int' => 'El ID del cliente debe ser un entero.',
            'customerId.exists' => 'El cliente no existe.',
            'customerName.required' => 'El nombre del cliente es requerido.',
            'customerName.string' => 'El nombre del cliente debe ser un string (texto).',
            'customerPhone.required' => 'El teléfono del cliente es requerido.',
            'customerIdentification.required' => 'El número de identificación del cliente es requerido.',
            'ticketId.required' => 'El ID del ticket es requerido.'
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $ticketId = $this->input('ticketId');
            $ticket = Ticket::find($ticketId);

            if ($ticket && !is_null($ticket->customer_id)) {
                $validator->errors()->add('ticketId', 'El ticket ya ha sido adquirido por otro usuario.');
            }
        });
    }
}
