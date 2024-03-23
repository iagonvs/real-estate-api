<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Seeder;

class BuildingsSeeder extends Seeder
{
    public function run(): void
    {
        $buildings = [
            ['id' => 1, 'name' => 'Edifício Central', 'address' => 'Rua Principal, 123', 'floors' => 10],
            ['id' => 2, 'name' => 'Torre Comercial', 'address' => 'Avenida Comercial, 456', 'floors' => 15],
            ['id' => 3, 'name' => 'Condomínio Park', 'address' => 'Rua dos Parques, 789', 'floors' => 8],
        ];

        foreach ($buildings as $building) {
            Building::query()->updateOrCreate(['id' => $building['id']],
                [
                    'name' => $building['name'],
                    'address' => $building['address'],
                    'floors' => $building['floors'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
