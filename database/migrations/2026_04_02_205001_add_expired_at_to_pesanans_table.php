<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->timestamp('expired_at')->nullable()->after('created_at');
        });
    }

    public function down()
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn('expired_at');
        });
    }
};
