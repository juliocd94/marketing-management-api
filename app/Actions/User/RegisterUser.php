<?php

namespace App\Actions\User;

use App\Actions\Company\CreateCompany;
use App\Events\UserRegistered;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

readonly class RegisterUser
{
    public function __construct(private User $user, private CreateCompany $createCompany)
    {
    }

    public function execute(array $validated): User
    {
        $company = $this->createCompany->execute(["name" => $validated['companyName']]);

        $user = $this->user->create([
            'company_id' => $company->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new UserRegistered($user));

        return $user;
    }
}
