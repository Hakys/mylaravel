<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->timestamp('fecha')->unique()->default(NOW());
            $table->float('peso',6,3)->default(0);
            $table->float('variacion',6,3)->default(0);
            $table->string('comentario')->nullable();
            $table->boolean('asistio')->default(false);
            $table->unsignedInteger('id_cliente')->unsigned()->nullable();
            $table->foreign('id_cliente')->references('id')->on('clientes');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas');
    }
}
