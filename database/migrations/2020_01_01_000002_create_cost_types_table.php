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
        Schema::create('cost_types', function (Blueprint $table) {
            $table->string('type_id')->primary();
            $table->string('costInvoicingType_id');
            $table->foreign('costInvoicingType_id')->references('type_id')->on('cost_invoicing_types');
            $table->string('caption');
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
        Schema::dropIfExists('cost_types');
    }
};
