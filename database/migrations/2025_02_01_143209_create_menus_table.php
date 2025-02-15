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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurant_id')->nullable();
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->unsignedBigInteger('kitchen_id')->nullable();
            $table->foreign('kitchen_id')->references('id')->on('kitchens')->onDelete('cascade');

            $table->string('sku')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 14, 4)->default(0);
            $table->decimal('cost', 14, 4)->default(0);

            $table->string('tax')->nullable();
            $table->string('barcode')->nullable();
            $table->string('calories')->nullable();
            $table->string('preparation_time')->nullable();
            $table->string('walking_minutes_to_burn_calories')->nullable();
            $table->tinyInteger('is_high_salt')->default(0); // Type (0 = No, 1 = Yes )

            $table->string('image')->nullable();
            $table->string('name_localized')->nullable();
            $table->text('description_localized')->nullable();

            $table->tinyInteger('is_active')->default(1); // Type (0 = inactive, 1 = active )

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->morphs('createable'); // Create Fileds kstockable_id , kstockable
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
        Schema::dropIfExists('menus');
    }
};
