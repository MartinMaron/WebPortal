<?php

namespace Database\Seeders;

use App\Models\CostType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new \App\Models\CostType)->create(['type_id' => 'BEK', 'caption' => 'Betriebskosten', 'costInvoicingType_id' => 'BE']);
        (new \App\Models\CostType)->create(['type_id' => 'BRK', 'caption' => 'Brennstoffkosten', 'costInvoicingType_id' => 'HZ']);
        (new \App\Models\CostType)->create(['type_id' => 'HNK', 'caption' => 'Heiznebenkosten', 'costInvoicingType_id' => 'HZ']);
        (new \App\Models\CostType)->create(['type_id' => 'ZUK', 'caption' => 'Zusatzkosten Heizung', 'costInvoicingType_id' => 'HZ']);
        (new \App\Models\CostType)->create(['type_id' => 'ZKW', 'caption' => 'Zusatzkosten Warmwasser', 'costInvoicingType_id' => 'HZ']);
        (new \App\Models\CostType)->create(['type_id' => 'KWK', 'caption' => 'Kaltwasserkosten', 'costInvoicingType_id' => 'HZ']);
        (new \App\Models\CostType)->create(['type_id' => 'SON', 'caption' => 'weitere Kosten', 'costInvoicingType_id' => 'HZ']);
        (new \App\Models\CostType)->create(['type_id' => 'ZWA', 'caption' => 'Zwischenablesung', 'costInvoicingType_id' => 'HZ']);
        (new \App\Models\CostType)->create(['type_id' => 'DIR', 'caption' => 'Direkkosten Nutzer', 'costInvoicingType_id' => 'HZ']);
        (new \App\Models\CostType)->create(['type_id' => 'BEE', 'caption' => 'Betriebskosten Nutzer', 'costInvoicingType_id' => 'BE']);
        (new \App\Models\CostType)->create(['type_id' => 'KWA', 'caption' => 'Abwasser', 'costInvoicingType_id' => 'HZ']);
        (new \App\Models\CostType)->create(['type_id' => 'ALR', 'caption' => 'Kosten der allg. Räume', 'costInvoicingType_id' => 'HZ']);
        (new \App\Models\CostType)->create(['type_id' => 'BEH', 'caption' => 'Betriebskosten (HZ)', 'costInvoicingType_id' => 'HZ']);
        (new \App\Models\CostType)->create(['type_id' => 'WAS', 'caption' => 'Wasserkosten', 'costInvoicingType_id' => 'HZ']);
    }
}
