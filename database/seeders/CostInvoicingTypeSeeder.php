<?php

namespace Database\Seeders;

use App\Models\CostInvoicingType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CostInvoicingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CostInvoicingType::create(['type_id' => 'BE', 'caption' => 'Betriebskostenabrechnung']);
        CostInvoicingType::create(['type_id' => 'HZ', 'caption' => 'Heizkostenabrechnung']);
        CostInvoicingType::create(['type_id' => 'NO', 'caption' => 'geht in keine Abrechnung']);
        CostInvoicingType::create(['type_id' => 'WA', 'caption' => 'Wasserabrechnung (Kalt und/oder  Warm)']);        
    }
}
