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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->unsignedBigInteger('warehouse_stock_id')->nullable();
            $table->foreign('warehouse_stock_id')->references('id')->on('warehouse_stocks')->onDelete('cascade');

            $table->decimal('quantity_request', 14, 4)->default(0);
            $table->decimal('quantity_available', 14, 4)->default(0);
            $table->decimal('cost', 14, 4)->default(0);

            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
