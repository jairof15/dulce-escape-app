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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('description', 50)->notNullable()->default('Descripción ...')->coments('Descripción del producto.');
            $table->decimal('cost', 10, 2)->nullable()->default(0.00)->coments('Costo del producto.');
            $table->decimal('profit_percentage', 10, 2)->nullable()->default(0.25)->coments('Porcentaje de ganancia del producto.');
            $table->decimal('price', 10, 2)->nullable()->default(0.00)->coments('Precio de venta del producto.');
            $table->integer('stock')->nullable()->default(0)->coments('Stock del producto.');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
