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
            $table->unsignedBigInteger('activeAbrechnungssetting_id')->nullable();
            $table->foreign('activeAbrechnungssetting_id')->references('id')->on('realestate_abrechnungssettings')->onDelete('cascade');
            $table->dropColumn('periodFrom');
            $table->dropColumn('periodTo');
        });

        Schema::table('realestate_abrechnungssettings', function($table)
        {
            $table->date('periodFrom')->nullable();
            $table->date('periodTo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
