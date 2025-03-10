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
        Schema::create('kitchen_stock_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kitchen_stock_id')->nullable();
            $table->foreign('kitchen_stock_id')->references('id')->on('kitchen_stocks')->onDelete('cascade');

            $table->enum('type', ['Add', 'Reduce', 'Return'])->default('Add'); // Data Type (Add, Remove, Return)

            $table->timestamp('date')->nullable();
            $table->decimal('quantity', 14, 4)->default(0);
            $table->text('notes')->nullable();

            $table->morphs('createable'); // Create Fileds movable_id , movable

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kitchen_stock_movements');
    }
};
