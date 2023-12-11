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
        Schema::table('users', function($table)
        {
            $table->boolean('isAdmin')->default(0);
            $table->boolean('isUser') ->default(0);
            $table->boolean('isMieter')->default(0);
            $table->string('apiToken')->nullable();
            $table->string('kundennummer')->nullable();
            $table->unsignedBigInteger('createdFromWebForOccupant')->nullable();
            $table->foreign('createdFromWebForOccupant')->references('id')->on('occupants')->onDelete('cascade');
        });
    }



    /**

     * Reverse the migrations.

     *

     * @return void

     */

    public function down()
    {
        Schema::dropIfExists('sessions');
    }

};

