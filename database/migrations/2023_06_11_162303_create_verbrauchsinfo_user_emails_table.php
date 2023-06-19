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
        Schema::create('verbrauchsinfo_user_emails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('realestate_id');
            $table->foreign('realestate_id')->references('id')->on('realestates');
            $table->date('dateFrom');
            $table->date('dateTo')->nullable();
            $table->unsignedInteger('nutzeinheitNo');
            $table->string('neko_id', 40);
            $table->boolean('aktiv')->nullable();
            $table->string('email', 255);
            $table->boolean('webupdate')->default(0);
            $table->string('firstinitUsername')->nullable();
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
        Schema::dropIfExists('verbrauchsinfo_user_emails');
    }
};
