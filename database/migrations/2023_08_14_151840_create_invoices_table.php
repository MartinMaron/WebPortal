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
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('createDate');
            $table->string('caption');
            $table->string('description');
            $table->string('fileName');
            $table->unsignedBigInteger('realestate_id');
            $table->foreign('realestate_id')->references('id')->on('realestates');
            $table->string('nekoId', 40);
            $table->date('dateFrom');
            $table->date('dateTo');
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
        Schema::dropIfExists('invoices');
    }
};