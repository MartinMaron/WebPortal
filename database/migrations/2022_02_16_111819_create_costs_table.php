<?php



use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;



class CreateCostsTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('realestate_id');
            $table->foreign('realestate_id')->references('id')->on('realestates');
            $table->integer('nekoId')->nullable();
            $table->string('caption')->nullable();
            $table->longText('description')->nullable();
            /* Betriebskosten, Brennstoffkosten, Zusatzkosten ...etc. */
            $table->String('costType_id');
            /* Gas, Heizöl, Fernwärme, Pellets, Strom ...etc. */
            $table->String('fuelType_id')->nullable();
            $table->double('startValue')->nullable();
            $table->double('startValueAmountNet')->nullable();
            $table->double('startValueAmountGros')->nullable();
            $table->double('startValueAmountVat')->nullable();
            $table->double('endValue')->nullable();
            $table->boolean('haushaltsnah')->nullable();
            $table->boolean('co2Tax')->default(0);                        
            /* Umlageschlüssel */
            $table->unsignedBigInteger('allocationKey_id')->nullable();
            $table->foreign('allocationKey_id')->references('id')->on('cost_keys');
            $table->text('noticeForUser')->nullable();
            $table->text('noticeForNeko')->nullable();
            $table->boolean('consumption')->default(0);                        
            $table->integer('OptimisticLockField')->nullable();
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
        Schema::dropIfExists('costs');
    }
}

