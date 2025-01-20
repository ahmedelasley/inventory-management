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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');

            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');

            $table->string('code')->unique();
            $table->string('invoice_number')->nullable();
            $table->integer('items')->default(0);
            $table->decimal('quantities', 14, 4)->default(0);
            $table->decimal('subtotal', 14, 4)->default(0);
            $table->decimal('tax', 14, 4)->default(0);
            $table->decimal('additional_cost', 14, 4)->default(0);
            $table->decimal('discount', 14, 4)->default(0);

            $table->timestamp('invoice_date')->nullable();
            $table->timestamp('business_date')->nullable();

            $table->enum('type', ['Purchasing', 'Return', 'Draft'])->default('Purchasing'); // Data Type (Purchasing, Return, Draft)
            $table->enum('status', ['Pending', 'Closed'])->default('Pending'); // Data status (Pending, Closed)

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
        Schema::dropIfExists('purchases');
    }
};
