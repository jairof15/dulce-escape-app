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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('date')->notNullable()->default(now())->coments('Fecha de la venta.');
            $table->foreignId('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('total', 10, 2)->nullable()->default(0.00)->coments('Total de la venta.');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
