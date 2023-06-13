<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create(["caption" => 'Quadratmeter',"shortname" => 'm²']);
        Unit::create(["caption" => 'Cubikmeter',"shortname" => 'm³']);
        Unit::create(["caption" => 'Personentage',"shortname" => 'm²']);
        Unit::create(["caption" => 'Kilowattstunden',"shortname" => 'kWh']);
        Unit::create(["caption" => 'Sondereinheiten',"shortname" => 'Son.']);
        Unit::create(["caption" => 'Mieteigentumseinheiten',"shortname" => 'ME']);
        Unit::create(["caption" => 'Wohneinheiten',"shortname" => 'WE']);
        Unit::create(["caption" => 'Prozente',"shortname" => '%']);
        Unit::create(["caption" => 'Liter',"shortname" => 'Ltr.']);
        Unit::create(["caption" => 'GigaJoule',"shortname" => 'GJ']);
        Unit::create(["caption" => 'Kilogramm',"shortname" => 'Kg']);
        Unit::create(["caption" => 'Einheiten',"shortname" => 'Einh.']);
        Unit::create(["caption" => 'Anzahl',"shortname" => 'Anz.']);
        Unit::create(["caption" => 'Festkosten und Verbrauch',"shortname" => 'Son.']);
    }
}
