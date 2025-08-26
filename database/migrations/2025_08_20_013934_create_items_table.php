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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('brand'); // merk barang
            $table->string('qr_code')->unique(); // kode QR
            $table->string('type'); // tipe barang
            $table->foreignId('room_id')->constrained()->onDelete('cascade'); // ruangan
            $table->text('description')->nullable(); // deskripsi (opsional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
