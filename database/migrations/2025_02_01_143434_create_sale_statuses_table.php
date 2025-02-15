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
        Schema::create('sale_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id')->nullable();
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->enum('old_status', ['Null', 'Pending', 'Completed'])->default('Null'); // Data Type (Pending, Processed, Shipped)
            $table->enum('new_status', ['Pending', 'Completed'])->default('Pending'); // Data Type (Pending, Processed, Shipped)
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
        Schema::dropIfExists('sale_statuses');
    }
};
