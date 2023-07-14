<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZaehlerArtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('zaehler_arten')->insert(["id" => 'KWZ',"caption" => 'Kaltwasserzähler',"einheit_id" => '2',"sort_reihenfolge" => '4']);
        DB::table('zaehler_arten')->insert(["id" => 'STZ',"caption" => 'Stromzähler',"einheit_id" => '4',"sort_reihenfolge" => '5']);
        DB::table('zaehler_arten')->insert(["id" => 'WWZ',"caption" => 'Warmwasserzähler',"einheit_id" => '2',"sort_reihenfolge" => '3']);
        DB::table('zaehler_arten')->insert(["id" => 'WMZ',"caption" => 'Wärmemengenzähler',"einheit_id" => '4',"sort_reihenfolge" => '1']);
        DB::table('zaehler_arten')->insert(["id" => 'HKV',"caption" => 'Heizkostenverteiler',"einheit_id" => '12',"sort_reihenfolge" => '2']);
        DB::table('zaehler_arten')->insert(["id" => 'GAS',"caption" => 'Gaszähler',"einheit_id" => '2',"sort_reihenfolge" => '6']);
        DB::table('zaehler_arten')->insert(["id" => 'ZUB',"caption" => 'Zubehör',"einheit_id" => '5',"sort_reihenfolge" => '7']);
        DB::table('zaehler_arten')->insert(["id" => 'RWM',"caption" => 'Rauchwarnmelder',"einheit_id" => '5',"sort_reihenfolge" => '8']);
    }
}
