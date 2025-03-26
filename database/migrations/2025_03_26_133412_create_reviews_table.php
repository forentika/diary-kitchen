<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->integer('rating')->checkBetween(1, 5);
            $table->text('comment')->nullable();
            $table->timestamp('review_date')->useCurrent();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('reviews');
    }
};
