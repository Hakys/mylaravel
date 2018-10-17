<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('full_name');
            $table->timestamp('f_nacimiento')->nullable();
            $table->string('email')->unique();
            $table->string('telefono',12)->unique();
            $table->boolean('activo')->default(false);
            $table->longText('anotaciones')->nullable();
            $table->float('peso_inicial',6,3)->default(0);
            $table->float('peso_saludable',6,3)->default(0);
            $table->float('altura',6,3)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
