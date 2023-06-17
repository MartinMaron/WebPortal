<?php

namespace Database\Seeders;

use App\Models\ZaehlerArt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZaehlerArtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ZaehlerArt::create(["id" => 'KWZ',"caption" => 'Kaltwasserzähler',"einheit_id" => '2',"sort_reihenfolge" => '4']);
        ZaehlerArt::create(["id" => 'STZ',"caption" => 'Stromzähler',"einheit_id" => '4',"sort_reihenfolge" => '5']);
        ZaehlerArt::create(["id" => 'WWZ',"caption" => 'Warmwasserzähler',"einheit_id" => '2',"sort_reihenfolge" => '3']);
        ZaehlerArt::create(["id" => 'WMZ',"caption" => 'Wärmemengenzähler',"einheit_id" => '4',"sort_reihenfolge" => '1']);
        ZaehlerArt::create(["id" => 'HKV',"caption" => 'Heizkostenverteiler',"einheit_id" => '12',"sort_reihenfolge" => '2']);
        ZaehlerArt::create(["id" => 'GAS',"caption" => 'Gaszähler',"einheit_id" => '2',"sort_reihenfolge" => '6']);
        ZaehlerArt::create(["id" => 'ZUB',"caption" => 'Zubehör',"einheit_id" => '5',"sort_reihenfolge" => '7']);
        ZaehlerArt::create(["id" => 'RWM',"caption" => 'Rauchwarnmelder',"einheit_id" => '5',"sort_reihenfolge" => '8']);
    }
}
