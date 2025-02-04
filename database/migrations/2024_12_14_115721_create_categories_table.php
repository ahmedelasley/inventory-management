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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->tinyInteger('is_default')->default(0); // Type (0 = Not Default, 1 = Defualt )
            $table->tinyInteger('type')->default(0); // Type (0 = stock, 1 = menu )

            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('categories');
    }
};
