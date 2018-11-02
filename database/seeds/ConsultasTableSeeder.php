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
        $ano=2018;
        $meses=range(1,12);
        $meses=[1,3,5,7,9];
        $dias=range(1,28);
        //$dias=[1];
        $horas = range(9,14);//+range(16,20);
        //$horas = array(9);
        $minutos=range(0,59,10);
        //echo $fecha_ini=Carbon::create(date('Y'),1,1,0,0,0,'Europe/Madrid')->timestamp;
        //echo $fecha_fin=Carbon::create(date('Y'),2,1,0,0,0,'Europe/Madrid')->timestamp;
        foreach ($meses as $mes){
            foreach ($dias as $dia){
                foreach ($horas as $hora){
                    foreach ($minutos as $min){
                        $f_ini = Carbon::create($ano,$mes,$dia,$hora,$min,0,'Europe/Madrid');
                        \DB::table('consultas')->insert([
                            'fecha' => $f_ini,
                            'start' => $f_ini->timestamp*1000,
                            /*
                            'end' => ($f_ini->timestamp+600)*1000,
                            'title' => 'evento'.$f_ini,
                            'body' => 'cuerpo del evento'.$f_ini,
                            'url' => 'www.google.com',
                            */
                            'created_at' => NOW(),
                            'updated_at' => NOW(),
                        ]);
                    }
                }
            }
        }

        $clientes = Cliente::all();
        foreach($clientes as $cliente){
            $consulta0 = Consulta::where('asistio',0)->first();
            $consulta0->cliente_id = $cliente->id;
            $consulta0->peso = $cliente->peso_inicial;
            $consulta0->comentario = 'consulta inicial';
            $consulta0->asistio = 1;
            $consulta0->save();
        }
        
        $limit=6;
        $cliente=Cliente::find(1);
        $peso=$cliente->peso_inicial;
        $consultas = Consulta::where('asistio',0)->orderby('fecha')->get();
        foreach($consultas as $consulta){
                if($limit<6*7){
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
        */
        $consultas = Consulta::where('asistio',0)->get();
        foreach($consultas as $consulta){
            $consulta ->delete();
        }
    }
}
