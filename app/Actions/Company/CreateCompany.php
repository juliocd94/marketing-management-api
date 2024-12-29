<?php

namespace App\Actions\Company;

use App\Events\CompanyCreated;
use App\Models\Company;
use Illuminate\Support\Str;

readonly class CreateCompany
{
    public function __construct(private Company $company)
    {
    }

    public function execute(array $validated): Company
    {
        do {
            $uniqueCode = Str::random(6);
        } while ($this->company->where('code', $uniqueCode)->exists());

        $company = $this->company->create([
            'plan_id' => $validated['planId'] ?? 1,
            'name' => $validated['name'],
            'code' => $uniqueCode,
        ]);

        event(new CompanyCreated($company));

        return $company;
    }
}
