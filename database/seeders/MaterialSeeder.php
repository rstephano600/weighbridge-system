<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        Material::insert([
            [
                'name' => 'PHOSPATE',
                'unit' => 'Tons',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'name' => 'Gravel',
            //     'type' => 'Raw',
            //     'unit' => 'Tons',
            //     'user_id' => 1,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'Cement',
            //     'type' => 'Finished',
            //     'unit' => 'Bags',
            //     'user_id' => 1,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'Limestone',
            //     'type' => 'Raw',
            //     'unit' => 'Tons',
            //     'user_id' => 1,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'Clinker',
            //     'type' => 'Intermediate',
            //     'unit' => 'Tons',
            //     'user_id' => 1,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);
    }
}