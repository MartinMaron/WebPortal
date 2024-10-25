<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\unitUsageType;

class UnitUsageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new \App\Models\UnitUsageType)->create(['type_id' => 'APP', 'caption' => 'Appartament']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'ARM', 'caption' => 'Allgemeine Räume']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'AT ', 'caption' => 'Atelier']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'BRO', 'caption' => 'Büro']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'EIL', 'caption' => 'Einzelhandel + Lager']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'EIZ', 'caption' => 'Einzelhandel']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'ETG', 'caption' => 'Etage']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'GAR', 'caption' => 'Garage']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'GAS', 'caption' => 'Gaststätte']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'GEW', 'caption' => 'Gewerbe']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'HAL', 'caption' => 'Halle']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'HUB', 'caption' => 'Halle u. Büro']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'KEL', 'caption' => 'Keller']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'LAD', 'caption' => 'Laden']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'LAG', 'caption' => 'Lager']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'LGE', 'caption' => 'Logische Einheit']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'PRA', 'caption' => 'Praxis']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'PT ', 'caption' => 'Physiotherapie']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'STL', 'caption' => 'Stellplatz']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'TNH', 'caption' => 'Tennishalle']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'WHG', 'caption' => 'Wohnung']);
        (new \App\Models\UnitUsageType)->create(['type_id' => 'ZIM', 'caption' => 'Zimmer']);

    }
}
