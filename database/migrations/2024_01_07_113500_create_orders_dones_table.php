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
        Schema::create('orders_dones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete(); 
            $table->foreignId('rosa_id')->references('id')->on('rosas')->cascadeOnDelete(); 
            $table->integer('quantity');
            $table->integer('total_price');
            $table->string('payments')->default('finished');
            $table->string('address');
            $table->date('MoveDate');
            $table->integer('number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_dones');
    }
};
