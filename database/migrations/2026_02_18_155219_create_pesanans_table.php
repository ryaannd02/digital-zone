<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->integer('total_harga');

            // STATUS PEMBAYARAN
            $table->enum('payment_status', ['pending', 'paid', 'failed'])
                ->default('pending');

            // STATUS PESANAN (OPERASIONAL)
            $table->enum('order_status', ['tertunda', 'diproses', 'dikirim', 'selesai'])
                ->default('tertunda');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
