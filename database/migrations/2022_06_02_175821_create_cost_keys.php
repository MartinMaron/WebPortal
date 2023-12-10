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
        Schema::create('cost_keys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nekoCostKey_id')->default(0);
            $table->integer('nekoKey_id')->default(0);
            $table->unsignedBigInteger('realestate_id');
            $table->foreign('realestate_id')->references('id')->on('realestates');
            $table->string('bemerkung',500)->nullable();
            $table->string('description',500)->nullable();
            $table->string('zeitanteil')->default(0);
            $table->string('einheit');
            $table->string('shortKey');
            $table->string('viewText');
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

        Schema::dropIfExists('cost_keys');

    }

};

