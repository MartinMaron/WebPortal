<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SalutationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Salutation::create(['bezeichnung' => 'Bitte auswählen']);
        (new \App\Models\Salutation)->create(['bezeichnung' => 'Frau']);
        (new \App\Models\Salutation)->create(['bezeichnung' => 'Eheleute']);
        (new \App\Models\Salutation)->create(['bezeichnung' => 'Herrn u. Frau']);
        (new \App\Models\Salutation)->create(['bezeichnung' => 'Frau u. Herrn']);
        (new \App\Models\Salutation)->create(['bezeichnung' => 'Firma']);
        (new \App\Models\Salutation)->create(['bezeichnung' => 'ETG']);
        (new \App\Models\Salutation)->create(['bezeichnung' => 'Herrn']);
        (new \App\Models\Salutation)->create(['bezeichnung' => 'WEG']);
        (new \App\Models\Salutation)->create(['bezeichnung' => 'Erbengemeinschaft']);

    }
}
