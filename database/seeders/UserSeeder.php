<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'company_id' => 1,
                'name' => 'Julio Duque',
                'email' => 'juliocd94@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => null
            ]
        ];

        User::insert($users);
    }
}
