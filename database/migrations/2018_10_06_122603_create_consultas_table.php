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
            
            $table->float('peso',6,3)->default(0);
            $table->float('variacion',6,3)->default(0);
            $table->string('comentario')->nullable();
            $table->boolean('asistio')->default(false);
            $table->dateTime('fecha')->unique()->nullable();
            $table->bigInteger('start')->nullable();
            
            /*
            $table->string('title',150)->nullable();
            $table->string('body')->nullable();
            $table->string('url',150)->nullable();
            $table->string('class',45)->default('event-important');
            
            $table->bigInteger('end')->nullable();
            $table->string('inicio_normal',50)->nullable();
            $table->string('final_normal',50)->nullable();
            */
            
            $table->unsignedInteger('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');            
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
