<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Einheit;

class EinheitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Einheit::create(["caption" => 'Quadratmeter',"shortname" => 'm²']);
        Einheit::create(["caption" => 'Cubikmeter',"shortname" => 'm³']);
        Einheit::create(["caption" => 'Personentage',"shortname" => 'm²']);
        Einheit::create(["caption" => 'Kilowattstunden',"shortname" => 'kWh']);
        Einheit::create(["caption" => 'Sondereinheiten',"shortname" => 'Son.']);
        Einheit::create(["caption" => 'Mieteigentumseinheiten',"shortname" => 'ME']);
        Einheit::create(["caption" => 'Wohneinheiten',"shortname" => 'WE']);
        Einheit::create(["caption" => 'Prozente',"shortname" => '%']);
        Einheit::create(["caption" => 'Liter',"shortname" => 'Ltr.']);
        Einheit::create(["caption" => 'GigaJoule',"shortname" => 'GJ']);
        Einheit::create(["caption" => 'Kilogramm',"shortname" => 'Kg']);
        Einheit::create(["caption" => 'Einheiten',"shortname" => 'Einh.']);
        Einheit::create(["caption" => 'Anzahl',"shortname" => 'Anz.']);
        Einheit::create(["caption" => 'Festkosten und Verbrauch',"shortname" => 'Son.']);
    }
}
