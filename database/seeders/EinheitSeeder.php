<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EinheitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('einheiten')->insert(["caption" => 'Quadratmeter',"shortname" => 'm²']);
        DB::table('einheiten')->insert(["caption" => 'Cubikmeter',"shortname" => 'm³']);
        DB::table('einheiten')->insert(["caption" => 'Personentage',"shortname" => 'm²']);
        DB::table('einheiten')->insert(["caption" => 'Kilowattstunden',"shortname" => 'kWh']);
        DB::table('einheiten')->insert(["caption" => 'Sondereinheiten',"shortname" => 'Son.']);
        DB::table('einheiten')->insert(["caption" => 'Mieteigentumseinheiten',"shortname" => 'ME']);
        DB::table('einheiten')->insert(["caption" => 'Wohneinheiten',"shortname" => 'WE']);
        DB::table('einheiten')->insert(["caption" => 'Prozente',"shortname" => '%']);
        DB::table('einheiten')->insert(["caption" => 'Liter',"shortname" => 'Ltr.']);
        DB::table('einheiten')->insert(["caption" => 'GigaJoule',"shortname" => 'GJ']);
        DB::table('einheiten')->insert(["caption" => 'Kilogramm',"shortname" => 'Kg']);
        DB::table('einheiten')->insert(["caption" => 'Einheiten',"shortname" => 'Einh.']);
        DB::table('einheiten')->insert(["caption" => 'Anzahl',"shortname" => 'Anz.']);
        DB::table('einheiten')->insert(["caption" => 'Festkosten und Verbrauch',"shortname" => 'Son.']);
    }
}
