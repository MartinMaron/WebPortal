<?php



use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;

use phpDocumentor\Reflection\Types\Nullable;



class CreateCostAmountsTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('cost_amounts', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('cost_id')->default(0);

            $table->foreign('cost_id')->references('id')->on('costs');

            $table->unsignedBigInteger('nekoId')->default(0);

            $table->string('bemerkung')->nullable();

            $table->string('tryWebDelete')->nullable(); 

            $table->string('description')->nullable();

            $table->string('netAmount')->default(0);

            $table->string('grosAmount')->default(0);

            $table->date('dateCostAmount')->nullable();

            $table->string('consumption')->nullable();

            $table->string('grosAmount_HH')->default(0);
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

        Schema::dropIfExists('cost_amounts');

    }

}

