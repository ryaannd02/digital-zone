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

            $table->foreignId('alamat_id')->nullable()->constrained('alamats')->nullOnDelete();
            $table->string('layanan_pengiriman')->nullable();
            $table->integer('ongkir')->default(0);
            $table->integer('total_harga');
            $table->integer('total_bayar')->default(0);

            $table->enum('payment_status', ['pending','paid','failed'])->default('pending');
            $table->enum('order_status', ['tertunda','diproses','dikirim','selesai'])->default('tertunda');

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
