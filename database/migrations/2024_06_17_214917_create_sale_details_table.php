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
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->references('id')->on('sales')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantity')->nullable()->default(1)->coments('Cantidad de productos vendidos.');
            $table->decimal('price', 10, 2)->nullable()->default(0.00)->coments('Precio de venta del producto.');
            $table->decimal('total', 10, 2)->nullable()->default(0.00)->coments('Total de la venta del producto.');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};
