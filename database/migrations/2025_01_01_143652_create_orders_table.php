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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('kitchen_id')->nullable();
            $table->foreign('kitchen_id')->references('id')->on('kitchens')->onDelete('cascade');

            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');

            $table->string('code')->unique();
            $table->integer('items')->default(0);
            $table->decimal('quantities', 14, 4)->default(0);
            $table->decimal('subtotal', 14, 4)->default(0);
            $table->decimal('tax', 14, 4)->default(0);

            $table->timestamp('request_date')->nullable();
            $table->timestamp('response_date')->nullable();

            $table->enum('type', ['Pending', 'Send', 'Processed', 'Shipped', 'Received'])->default('Pending'); // Data Type (Pending, Send, Processed, Shipped, Received)
            $table->enum('status', ['Open', 'Closed', 'Draft'])->default('Open'); // Data Type (Open, Closed, Draft)
            $table->text('notes')->nullable();

            $table->morphs('createable'); // Create Fileds createable_id , createable_type
            $table->string('updateable_type')->nullable();
            $table->unsignedBigInteger('updateable_id')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
