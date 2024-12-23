<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $customers = [
            [
                'id' => 1,
                'company_id' => 1,
                'name' => 'Juan Pérez',
                'identification_type' => 'Cédula',
                'identification' => '12345678',
                'address' => 'USA, Texas, Huston',
                'phone' => '+584247265818'
            ],
            [
                'id' => 2,
                'company_id' => 1,
                'name' => 'Ana López',
                'identification_type' => 'Cédula',
                'identification' => '87654321',
                'address' => 'Venezuela, Merida, Bailadores',
                'phone' => '+574247268818'
            ],
            [
                'id' => 3,
                'company_id' => 1,
                'name' => 'Carlos Sánchez',
                'identification_type' => 'Pasaporte',
                'identification' => 'A12345678',
                'address' => 'Venezuela, Táchira, La Grita',
                'phone' => '+554247265678'
            ],
            [
                'id' => 4,
                'company_id' => 1,
                'name' => 'María García',
                'identification_type' => 'DNI',
                'identification' => '98765432',
                'address' => 'Zona Industrial, Bloque 8',
                'phone' => '+14244578238'
            ],
            [
                'id' => 5,
                'company_id' => 1,
                'name' => 'Pedro Gómez',
                'identification_type' => 'Cédula',
                'identification' => '45678912',
                'address' => 'Urbanización Jardines, Lote 14',
                'phone' => '+14265478238'
            ],
            [
                'id' => 6,
                'company_id' => 1,
                'name' => 'Laura Torres',
                'identification_type' => 'Pasaporte',
                'identification' => 'B98765432',
                'address' => 'Plaza Mayor 10',
                'phone' => '+14123458238'
            ],
            [
                'id' => 7,
                'company_id' => 1,
                'name' => 'Diego Rivera',
                'identification_type' => 'DNI',
                'identification' => '32145678',
                'address' => 'Calle Secundaria 202',
                'phone' => '+14321578238'
            ],
            [
                'id' => 8,
                'company_id' => 1,
                'name' => 'Sofía Morales',
                'identification_type' => 'Cédula',
                'identification' => '65478912',
                'address' => 'Villa Sol, Torre B',
                'phone' => '+19874578238'
            ],
            [
                'id' => 9,
                'company_id' => 1,
                'name' => 'Luis Fernández',
                'identification_type' => 'Pasaporte',
                'identification' => 'C12398765',
                'address' => 'Colonia Las Rosas, Edificio 3',
                'phone' => '+15873578238'
            ],
            [
                'id' => 10,
                'company_id' => 1,
                'name' => 'Valeria Castillo',
                'identification_type' => 'DNI',
                'identification' => '15975346',
                'address' => 'Avenida Libertad, Local 7',
                'phone' => '+19872588238'
            ],
        ];

        Customer::insert($customers);
    }
}
