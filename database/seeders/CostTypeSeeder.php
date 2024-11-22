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
        CostType::create(['type_id' => 'BEK', 'caption' => 'Betriebskosten', 'costInvoicingType_id' => 'BE', 'sort' => 1001]);
        CostType::create(['type_id' => 'BRK', 'caption' => 'Brennstoffkosten', 'costInvoicingType_id' => 'HZ', 'sort' => 1]);
        CostType::create(['type_id' => 'HNK', 'caption' => 'Heiznebenkosten', 'costInvoicingType_id' => 'HZ', 'sort' => 2]);
        CostType::create(['type_id' => 'ZUK', 'caption' => 'Zusatzkosten Heizung', 'costInvoicingType_id' => 'HZ', 'sort' => 3]);
        CostType::create(['type_id' => 'ZKW', 'caption' => 'Zusatzkosten Warmwasser', 'costInvoicingType_id' => 'HZ', 'sort' => 4]);
        CostType::create(['type_id' => 'KWK', 'caption' => 'Kaltwasserkosten', 'costInvoicingType_id' => 'HZ', 'sort' => 5]);
        CostType::create(['type_id' => 'ZWA', 'caption' => 'Zwischenablesung', 'costInvoicingType_id' => 'HZ', 'sort' => 98]);
        CostType::create(['type_id' => 'DIR', 'caption' => 'Direkkosten Nutzer', 'costInvoicingType_id' => 'HZ', 'sort' => 97]);
        CostType::create(['type_id' => 'BEE', 'caption' => 'Betriebskosten Nutzer', 'costInvoicingType_id' => 'BE', 'sort' => 1002]);
        CostType::create(['type_id' => 'KWA', 'caption' => 'Abwasser', 'costInvoicingType_id' => 'HZ', 'sort' => 6]);
        CostType::create(['type_id' => 'BEH', 'caption' => 'Betriebskosten (HZ)', 'costInvoicingType_id' => 'HZ', 'sort' => 7]);
    }
}
