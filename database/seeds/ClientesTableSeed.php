<?php

use Illuminate\Database\Seeder;

class ClientesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('clientes')->insert([
            'id' => 1,
            'full_name' => 'antonio primero',
            'f_nacimiento' => '1982-03-03',
            'email' => 'hakyss@gmail.com',
            'telefono' => '653178954',
            'activo' => 1,
            'anotaciones' => 'comentario del cliente antonio primero',
            'peso_inicial' => 140,
            'peso_saludable' => 85,
            'altura' => 1.75,
            'created_at' => '2018-01-01',
            'updated_at' => NOW(),
        ]);  
        \DB::table('clientes')->insert([
            'id' => 2,
            'full_name' => 'antonio segudo',
            'f_nacimiento' => '1990-10-25',
            'email' => 'hakyss@hotmail.com',
            'telefono' => '653178950',
            'activo' => 1,
            'anotaciones' => 'comentario del cliente antonio segundo',
            'peso_inicial' => 100,
            'peso_saludable' => 65,
            'altura' => 1.65,
            'created_at' => '2018-01-01',
            'updated_at' => NOW(),
        ]);   
        \DB::table('clientes')->insert([
            'id' => 3,
            'full_name' => 'antonio tercero',
            'f_nacimiento' => '1995-8-10',
            'email' => 'info@diablaroja.es',
            'telefono' => '653178594',
            'activo' => 1,
            'anotaciones' => 'comentario del cliente antonio tercero',
            'peso_inicial' => 95,
            'peso_saludable' => 70,
            'altura' => 1.8,
            'created_at' => '2018-01-01',
            'updated_at' => NOW(),
        ]);   
        \DB::table('clientes')->insert([
            'id' => 4,
            'full_name' => 'antonio cuarto',
            'f_nacimiento' => '1988-06-13',
            'email' => 'compras@diablaroja.es',
            'telefono' => '653718954',
            'activo' => 1,
            'anotaciones' => 'comentario del cliente antonio cuarto',
            'peso_inicial' => 180,
            'peso_saludable' => 85,
            'altura' => 1.85,
            'created_at' => '2018-01-01',
            'updated_at' => NOW(),
        ]);   
        \DB::table('clientes')->insert([
            'id' => 5,
            'full_name' => 'antonio quinto',
            'f_nacimiento' => '2005-01-31',
            'email' => 'quinto@diablaroja.es',
            'telefono' => '653187954',
            'activo' => 1,
            'anotaciones' => 'comentario del cliente antonio quinto',
            'peso_inicial' => 95,
            'peso_saludable' => 70,
            'altura' => 1.70,
            'created_at' => '2018-01-01',
            'updated_at' => NOW(),
        ]);  
        \DB::table('clientes')->insert([
            'id' => 6,
            'full_name' => 'antonio sexto',
            'f_nacimiento' => '2005-01-31',
            'email' => 'quisexto@diablaroja.es',
            'telefono' => '653187444',
            'activo' => 1,
            'anotaciones' => 'comentario del cliente antonio  exto',
            'peso_inicial' => 123,
            'peso_saludable' => 70,
            'altura' => 1.75,
            'created_at' => '2018-01-01',
            'updated_at' => NOW(),
        ]);  
    }
}
