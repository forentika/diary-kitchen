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
        Schema::create('products', function (Blueprint $table) {
            $table->string('id_produk')->primary();
            $table->string('nama');
            $table->text('deskripsi');
            $table->decimal('harga', 10, 2)->nullable();;
            $table->integer('stok')->default(0);
            $table->enum('kategori', ['mocci', 'kimbab'])->default('mocci');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
