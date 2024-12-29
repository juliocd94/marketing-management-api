<?php

namespace App\Actions\Customer;

use App\Models\Customer;
use App\Models\User;

readonly class CreateCustomerAction
{
    public function __construct(private Customer $customer)
    {
    }

    /**
     * Ejecuta la creación de un nuevo cliente.
     *
     * @param array $validatedData
     * @param User $user
     * @return Customer
     */
    public function execute(array $validatedData, User $user): Customer
    {
        $customer = $this->customer->create([
            "company_id" => $user->company->id,
            "identification_type" => "Cédula",
            'identification' => $validatedData['customerIdentification'],
            'phone' => $validatedData['customerPhone'],
            'address' => $validatedData['customerAddress'],
            'name' => $validatedData['customerName']
        ]);

        return $customer;
    }
}
