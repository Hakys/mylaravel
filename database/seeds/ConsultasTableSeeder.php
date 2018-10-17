<?php

use Illuminate\Database\Seeder;
use App\Cliente;
use App\Consulta;

class ConsultasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ano=2018;
        $meses=range(1,12);
        //$meses=[1];
        $dias=range(1,28);
        //$dias=[1];
        $horas = range(9,14)+range(16,20);
        $horas = array(9);
        $minutos=range(0,59,10);
        foreach ($meses as $mes){
            foreach ($dias as $dia){
                foreach ($horas as $hora){
                    foreach ($minutos as $min){
                        \DB::table('consultas')->insert([
                            'fecha' => date('Y-m-d H:i:s',mktime($hora,$min,0,$mes,$dia,$ano)),
                        ]);
                    }
                }
            }
        }

        $clientes = Cliente::all();
        foreach($clientes as $cliente){
            $consulta0 = Consulta::where('asistio',0)->first();
            $consulta0->id_cliente = $cliente->id;
            $consulta0->peso = $cliente->peso_inicial;
            $consulta0->comentario = 'consulta inicial';
            $consulta0->asistio = 1;
            $consulta0->save();
        }
        
            $limit=6;
            $cliente=Cliente::find(1);
            $cliente_id=$cliente->id;
            $peso=$cliente->peso_inicial;
            $consultas = Consulta::where('asistio',0)->orderby('fecha')->get();
            foreach($consultas as $consulta){
                 if($limit<6*7){
                    $limit++;
                 }else{
                    $consulta->id_cliente = $cliente_id;
                    $consulta->variacion = (rand(-30,20)/10);
                    $peso += $consulta->variacion;
                    $consulta->peso = $peso;
                    $consulta->asistio = 1;
                    $consulta->save();
                    $limit=1;
                 }    
            }

            $limit=5;
            $cliente=Cliente::find(2);
            $cliente_id=$cliente->id;
            $peso=$cliente->peso_inicial;
            $consultas = Consulta::where('asistio',0)->orderby('fecha')->get();
            foreach($consultas as $consulta){
                 if($limit<5*7){
                    $limit++;
                 }else{
                    $consulta->id_cliente = $cliente_id;
                    $consulta->variacion = (rand(-30,20)/10);
                    $peso += $consulta->variacion;
                    $consulta->peso = $peso;
                    $consulta->asistio = 1;
                    $consulta->save();
                    $limit=1;
                 }    
            }
       
         
        /*
        foreach($clientes as $cliente){
            $consulta0 = Consulta::where('asistio',0)->orderByDesc('fecha')->first();
            $consulta0->id_cliente = $cliente->id;
            $consulta0->peso = $cliente->peso_saludable;
            $consulta0->comentario = 'consulta final';
            $consulta0->asistio = 1;
            $consulta0->save();
        }
        */
    }
}
