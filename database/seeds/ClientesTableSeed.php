<?php

use Illuminate\Database\Seeder;
use App\Cliente;
use App\Consulta;
use Carbon\Carbon;

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
            'created_at' => '2018-01-01 00:00',
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
            'created_at' => '2018-01-01 00:10',
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
            'created_at' => '2018-01-01 00:20',
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
            'created_at' => '2018-01-01 00:30',
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
            'created_at' => '2018-01-01 00:40',
            'updated_at' => NOW(),
        ]);  
        \DB::table('clientes')->insert([
            'id' => 6,
            'full_name' => 'antonio sexto',
            'f_nacimiento' => '2005-01-31',
            'email' => 'quisexto@diablaroja.es',
            'telefono' => '653187444',
            'activo' => 1,
            'anotaciones' => 'comentario del cliente antonio  sexto',
            'peso_inicial' => 123,
            'peso_saludable' => 70,
            'altura' => 1.75,
            'created_at' => '2018-01-01 00:50',
            'updated_at' => NOW(),
        ]); 
        \DB::table('clientes')->insert([
            'id' => 7,
            'full_name' => 'señor cansino',
            'f_nacimiento' => '2005-01-31',
            'email' => 'cansino@diablaroja.es',
            'telefono' => '653111444',
            'activo' => 1,
            'anotaciones' => 'comentario del cliente antonio cansinoexto',
            'peso_inicial' => 123,
            'peso_saludable' => 70,
            'altura' => 1.75,
            'created_at' => '2018-01-01 01:00',
            'updated_at' => NOW(),
        ]); 
        
        $clientes = Cliente::all();
        foreach($clientes as $cliente){

            $consulta0 = new Consulta();
            $consulta0->fecha = $cliente->created_at;
            $consulta0->start = $cliente->created_at->timestamp*1000;
            $consulta0->peso = $cliente->peso_inicial;
            $consulta0->comentario = 'consulta inicial';
            $consulta0->asistio = 1;
            $consulta0->cliente_id = $cliente->id;
            $consulta0->save();

            $consultafinal = new Consulta();
            $consultafinal->fecha = $cliente->created_at->copy()->addYear();
            $consultafinal->start = $consultafinal->fecha->timestamp*1000;
            $consultafinal->peso = $cliente->peso_saludable;
            $consultafinal->comentario = 'peso esperado';
            $consultafinal->asistio = 0;
            $consultafinal->cliente_id = $cliente->id;
            $consultafinal->save();
        }
    }
}
