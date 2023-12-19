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
            $table->string('nazwa')->nullable();
            $table->string('bemerkung')->nullable();
            $table->string('costType')->nullable();
            $table->String('costType_id');
            $table->double('vatAmount')->nullable();
            $table->string('fuelType')->nullable();
            $table->String('fuelType_id')->nullable();
            $table->boolean('hasTank')->nullable();
            $table->double('startValue')->nullable();
            $table->double('endValue')->nullable();
            $table->double('startValueAmount')->nullable();
            $table->boolean('haushaltsnah')->nullable();
            $table->unsignedBigInteger('keyId')->nullable();
            $table->string('keyName')->nullable();
            $table->string('keyShortkey')->nullable();
            $table->text('noticeForUser')->nullable();
            $table->text('noticeForNeko')->nullable();
            $table->string('costAbrechnungType')->nullable();
            $table->string('costAbrechnungTypeId')->nullable();
            $table->string('fuelTypeUnitType')->nullable();
            $table->string('fuelTypeUnitName')->nullable();
            $table->double('startValueAmountNet')->nullable();
            $table->double('startValueAmountGros')->nullable();
            $table->string('keyUnitType')->nullable();
            $table->boolean('consumption')->default(0);                        
            $table->boolean('co2Tax')->default(0);                        
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

