<?php

namespace Database\Seeders;

use App\Models\CostInvoicingType;
use App\Models\CostType;
use App\Models\FuelType;
use App\Models\Salutation;
use App\Models\ZaehlerArt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            SalutationSeeder::class,
            EinheitSeeder::class,
            ZaehlerArtSeeder::class,
            UnitUsageTypeSeeder::class,
            CostInvoicingTypeSeeder::class,
            CostTypeSeeder::class,
            FuelTypeSeeder::class,
        ]);


    }
}
