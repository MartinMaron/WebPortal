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
        Schema::table('invoices', function($table)
        {
            $table->string('vertragsart')->nullable();
            $table->boolean('bezahlt')->nullable();
            $table->date('bezahltAm')->nullable();
            $table->date('zahlungsAuftragDatum')->nullable();
            $table->string('zahlungsauftragIBAN')->nullable();
            $table->double('netto')->nullable()->default(0.0);
            $table->double('vat')->nullable()->default(0.0);
            $table->double('brutto')->nullable()->default(0.0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('vertragsart','bezahlt','bezahltAm','zahlungsAuftragDatum','zahlungsauftragIBAN','netto','vat','brutto');
        });
    }
};
