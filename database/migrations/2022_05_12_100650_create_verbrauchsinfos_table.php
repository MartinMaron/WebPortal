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
        Schema::create('verbrauchsinfos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nekoOccupant_id');
            $table->unsignedBigInteger('occupant_id');
            $table->foreign('occupant_id')->references('id')->on('occupants');
            $table->string('art',100);
            $table->string('einheit',100);
            $table->unsignedBigInteger('nutzergrup_id');
            $table->string('nutzergrup_name',150);
            $table->string('zeitraum_akt',21)->nullable();
            $table->string('zeitraum_mon',21)->nullable();
            $table->string('zeitraum_vorj',21)->nullable();
            $table->double('verbrauch_akt')->default(-1);
            $table->double('verbrauch_mon')->default(-1);
            $table->double('verbrauch_vorj')->default(-1);
            $table->integer('nekoId');
            $table->boolean('hk');
            $table->integer('ww');
            $table->double('durchschnitt')->default(0);            
            $table->string('jahr_monat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verbrauchsinfos');
    }
};
