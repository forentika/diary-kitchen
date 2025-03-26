<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('phone');
            $table->text('address')->nullable();
            $table->enum('order_type', ['take_away', 'dine_in']);
            $table->integer('table_number')->nullable(); // Hanya untuk dine-in
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'cooking', 'ready', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('orders');
    }
};

