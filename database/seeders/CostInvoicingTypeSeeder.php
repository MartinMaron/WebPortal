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
        (new \App\Models\CostInvoicingType)->create(['type_id' => 'BE', 'caption' => 'Betriebskostenabrechnung']);
        (new \App\Models\CostInvoicingType)->create(['type_id' => 'HZ', 'caption' => 'Heizkostenabrechnung']);
        (new \App\Models\CostInvoicingType)->create(['type_id' => 'NO', 'caption' => 'geht in keine Abrechnung']);
        (new \App\Models\CostInvoicingType)->create(['type_id' => 'WA', 'caption' => 'Wasserabrechnung (Kalt und/oder  Warm)']);
    }
}
