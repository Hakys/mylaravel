<?php

use Illuminate\Database\Seeder;
use App\Cliente;
use App\Consulta;
use Carbon\Carbon;

class ConsultasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientes = Cliente::all();
        foreach($clientes as $cliente){
            $peso=$cliente->peso_inicial;
            $fecha=$cliente->created_at;
            $limit=52;
            while($limit){
                $consulta = new Consulta();
                $consulta->cliente_id = $cliente->id;
                $consulta->fecha = $fecha->addWeek();
                $consulta->start = $consulta->fecha->timestamp*1000;
                $consulta->variacion = (rand(-30,20)/10);
                $peso += $consulta->variacion;
                $consulta->peso = $peso;
                $consulta->asistio = 1;
                $consulta->save();
                $limit--;
            }
            echo $cliente->full_name."\n";
        }
        /*
        $limit=5;
        $cliente=Cliente::find(2);
        $peso=$cliente->peso_inicial;
        $consultas = Consulta::where('asistio',0)->orderby('fecha')->get();
        foreach($consultas as $consulta){
            if($limit<5*7){
                $limit++;
            }else{
                $consulta->cliente_id = $cliente->id;
                $consulta->variacion = (rand(-30,20)/10);
                $peso += $consulta->variacion;
                $consulta->peso = $peso;
                $consulta->asistio = 1;
                $consulta->save();
                $limit=1;
            }    
        }
       
        $cliente=Cliente::find(7);
        for($i=0;$i<100;$i++){
            $consulta = Consulta::where('asistio',0)->orderby('fecha')->first();
            $consulta->cliente_id = $cliente->id;
            $consulta->variacion = (rand(-30,20)/10);
            $peso += $consulta->variacion;
            $consulta->peso = $peso;
            $consulta->asistio = 1;
            $consulta->save();
        }
        
        /*
        foreach($clientes as $cliente){
            $consulta0 = Consulta::where('asistio',0)->orderByDesc('fecha')->first();
            $consulta0->cliente_id = $cliente->id;
            $consulta0->peso = $cliente->peso_saludable;
            $consulta0->comentario = 'consulta final';
            $consulta0->asistio = 1;
            $consulta0->save();
        }
        

        $dias=range(1,28);
        $horas = range(10,14)+range(16,20);
        $minutos=range(0,59,10);
        foreach ($meses as $mes){
            foreach ($dias as $dia){
                foreach ($horas as $hora){
                    foreach ($minutos as $min){
                        \DB::table('consultas')->insert([
                            'fecha' => new DateTime("$ano-$mes-$dia $hora:$min:0"),
                            'created_at' => NOW(),
                            'updated_at' => NOW(),
                        ]);
                    }
                }
            }
        }
        *
        $consultas = Consulta::where('asistio',0)->get();
        foreach($consultas as $consulta){
            $consulta ->delete();
        }
        */
    }
}
