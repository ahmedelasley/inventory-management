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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->text('location')->nullable();
            $table->tinyInteger('is_default')->default(0); // Type (0 = Not Default, 1 = Defualt )

            $table->unsignedBigInteger('restaurant_id')->nullable();
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');

            $table->unsignedBigInteger('keeper_id')->nullable();
            $table->foreign('keeper_id')->references('id')->on('keepers')->onDelete('cascade');

            $table->unsignedBigInteger('created_id')->nullable();
            $table->foreign('created_id')->references('id')->on('admins')->onDelete('cascade');
            
            $table->unsignedBigInteger('updated_id')->nullable();
            $table->foreign('updated_id')->references('id')->on('admins')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
