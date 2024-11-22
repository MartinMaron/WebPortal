<?php

namespace Database\Seeders;

use App\Models\FuelType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FuelType::create(['type_id' => 'GS4', 'caption' => 'Gas', 'einheit_id' => 4, 'hasTank' => false]);
        FuelType::create(['type_id' => 'OL9', 'caption' => 'Heizöl', 'einheit_id' => 9, 'hasTank' => true]);
        FuelType::create(['type_id' => 'EC4', 'caption' => 'Fernwärme', 'einheit_id' => 4, 'hasTank' => false]);
        FuelType::create(['type_id' => 'EG1', 'caption' => 'Pellets', 'einheit_id' => 11, 'hasTank' => true]);
        FuelType::create(['type_id' => 'GS9', 'caption' => 'Flüssiggas', 'einheit_id' => 9, 'hasTank' => true]);
        FuelType::create(['type_id' => 'STZ', 'caption' => 'Strom', 'einheit_id' => 4, 'hasTank' => false]);
    }
}
