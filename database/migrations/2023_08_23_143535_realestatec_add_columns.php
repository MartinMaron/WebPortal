<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::table('realestates', function($table)

        {

            $table->boolean('occupant_name_mode')->default(0);

            $table->boolean('occupant_number_mode') ->default(0);



        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('realestates', function (Blueprint $table) {
            $table->dropColumn(['occupant_name_mode', 'occupant_number_mode']);
        });
    }
};
