<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pesanans', function (Blueprint $table) {

            $table->string('tracking_status')->nullable(); 
            // pickup | perjalanan | menuju_alamat | sampai

            $table->timestamp('tracking_started_at')->nullable();

            $table->string('ongkir_type')->nullable();
            // reguler | express | ekonomis

        });
    }

    public function down()
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn([
                'tracking_status',
                'tracking_started_at',
                'ongkir_type'
            ]);
        });
    }
};
