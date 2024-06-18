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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->String('name',50)->notNullable()->default('Nombre ...')->coments('Nombre del cliente.');
            $table->String('last_name',50)->notNullable()->default('Apellido ...')->coments('Apellido del cliente.');
            $table->String('document',25)->notNullable()->unique()->coments('Documento del cliente.');
            $table->Enum('document_type',['CI','Passport','NIT'])->notNullable()->default('CI')->coments('Tipo de documento del cliente.');
            $table->String('email',50)->nullable()->default('Ninguno.')->coments('Email del cliente.');
            $table->String('phone',20)->nullable()->default('Sin dato.')->coments('Teléfono del cliente.');
            $table->String('address',75)->nullable()->default('Sin dato.')->coments('Dirección del cliente.');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
