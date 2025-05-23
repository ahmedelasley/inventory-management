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
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->enum('old_status', ['Null', 'Pending', 'Send', 'Processed', 'Shipped'])->default('Null'); // Data Type (Pending, Processed, Shipped)
            $table->enum('new_status', ['Pending', 'Send', 'Processed', 'Shipped', 'Received'])->default('Pending'); // Data Type (Pending, Processed, Shipped)
            $table->timestamp('date')->nullable();

            $table->morphs('statusable'); // Create Fileds statusable_id , statusable

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_statuses');
    }
};
