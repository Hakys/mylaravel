<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Consulta;
use App\Cliente;
use View;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// Evaluar los datos que ingresa el usuario y eliminamos caracteres no deseados.
function evaluar($valor) {
	$nopermitido = array("'",'\\','<','>',"\"");
	$valor = str_replace($nopermitido, "", $valor);
	return $valor;
}

// Formatear una fecha a microtime para añadir al evento, tipo 1401517498985.
function _formatear($fecha){
	return strtotime(substr($fecha, 6, 4)."-".substr($fecha, 3, 2)."-".substr($fecha, 0, 2)." " .substr($fecha, 10, 6)) * 1000;
}

class ConsultaController extends Controller{
    protected $rules = [        
        'peso' => 'numeric',
        'variacion' => 'numeric',
        'cliente_id' => 'numeric',
        'asistio' => 'boolean',
        'comentario' => 'string',
        'fecha' => 'date',
    ];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //$consultas = Consulta::orderByDesc('fecha')->get();
        $consultas =Consulta::where('asistio',1)->orderbyDesc('fecha')->take(36)->get();
        //$clientes = Cliente::orderBy('full_name')->get();
        $clientes = Cliente::all();
        return view('consultas.index', ['consultas' => $consultas,'clientes' => $clientes]);
    }

    public function calendario(){
        $consultas = Consulta::where('asistio',1)->orderby('fecha')->get();
        $huecos = Consulta::where('asistio',0)->orderby('fecha')->get();
        $clientes = Cliente::all();
        return view('consultas.calendar', ['consultas' => $consultas,'clientes' => $clientes, 'huecos' => $huecos]);
    }
    
    public function diario_hoy(){
        return $this->diario(date('Y'),date('m'),date('d'));
    }
    
    public function diario($ano,$mes,$dia){
        $consultas = Consulta::where('fecha', '>=', date('Y-m-d',mktime(0,0,0,$mes,$dia,$ano)))
                            ->where('fecha', '<', date('Y-m-d',mktime(0,0,0,$mes,$dia+1,$ano)))
                            ->orderBy('fecha')->get();
        $clientes = Cliente::all();
        return view('consultas.diario', [
            'ano' => $ano, 'mes' => $mes, 'dia' => $dia,
            'consultas' => $consultas,'clientes' => $clientes]);
    }

    public function hoy(Request $request){
        //echo $carbon->toDateTimeString();
        //Carbon::parse('@'.$timestamp)
        //Carbon::createFromFormat('Y-m-d H', '1975-05-21 22')->toDateTimeString(); // 1975-05-21 22:00:00
        $today = Carbon::today('Europe/Madrid');
        $hoy = $today->timestamp*1000;    
        $mañana = Carbon::tomorrow('Europe/Madrid')->timestamp*1000;
        $consultas = Consulta::where('start','>=',$hoy)->where('start','<',$mañana)->get();
        //dd($consultas);
        $clientes = Cliente::all();
        $ano=$today->year;
        $mes=$today->month;
        $dia=$today->day;
        $horas = range(9,14)+range(16,20);
        $minutos=range(0,59,10);
        foreach ($horas as $hora){
            foreach ($minutos as $min){
                $date = Carbon::create($ano,$mes,$dia,$hora,$min,0,'Europe/Madrid');
                //dd($date);
                $cita = Consulta::where('start','=',$date->timestamp*1000)->first();
                //if($cita) dd($date.$cita->fecha);                                 
                $citas[] = [
                    'id' => $date->timestamp,
                    'start' => $date->timestamp,
                    'fecha' => $date->format('Y-m-d H:i'),
                    'hora' => $date->format('H:i'),
                    'consulta' => $cita, 
                ];      
            }
        }
        //dd($citas);
        return view('consultas.hoy', [
            'hoy' => $today->format('d / m / Y'),
            'first' => $citas[0],
            'citas' => $citas,
            'clientes' => $clientes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */ 
    public function create() {
        return redirect()->route('consultas.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $consulta = new Consulta();
            $consulta->cliente_id = $request->cliente_id;
            $consulta->peso = $request->peso;
            $consulta->comentario = $request->comentario;
            $consulta->save();
            return response()->json($consulta);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $consulta = Consulta::findOrFail($id);
        return view('consusltas.show', ['consulta' => $consulta]);
    }
    
    public function obtener_eventos(Request $request){
        //http://127.0.0.1:8000/diario/obtener_eventos?from=1512082800&to=1514761200
        
        //return Response::json(["success" => 11, "result" => \Carbon\Carbon::createFromTimeStamp('d-m-Y',$request->to)]);
        //return Response::json(["success" => 11, "result" => $inicio.$final ]);

        // Sentencia sql para traer los eventos desde la base de datos
        $consultas = Consulta::where('start','>=',$request->from)->where('start','<=',$request->to)->get();
        
        if($consultas){
            // Transformamos los datos encontrado en la BD al formato JSON
            return Response::json(array("success" => 1, "result" => $consultas));
        }else{
            // Si no existen eventos mostramos este mensaje.
            return Response::json(array("success" => 0, "error" => 'No hay datos')); 
        }
    }

    public function insertar_eventos(Request $request){
        echo($request->from);
        echo($request->to);
        echo($request->title);
        echo($request->event);

        // Recibimos el fecha de inicio y la fecha final desde el form

        $inicio = _formatear($request->from);
        // y la formateamos con la funcion _formatear

        $final  = _formatear($request->to);

        // Recibimos el fecha de inicio y la fecha final desde el form

        $inicio_normal = $request->from;

        // y la formateamos con la funcion _formatear
        $final_normal  = $request->to;

        // Recibimos los demas datos desde el form
        $titulo = evaluar($request->title);

        // y con la funcion evaluar
        $body   = evaluar($request->event);

        // reemplazamos los caracteres no permitidos
        $clase  = evaluar($request->class);
        
        // insertamos el evento
        // $query="INSERT INTO eventos VALUES(null,'$titulo','$body','','$clase','$inicio','$final','$inicio_normal','$final_normal')";
        $consulta = new Consulta();
        $consulta->cliente_id = $request->cliente_id;
        $consulta->peso = $request->peso;
        $consulta->comentario = $request->comentario;
        $consulta->save();

        // para generar el link del evento
        //$link = "$base_url"."descripcion_evento.php?id=$id";
        // y actualizamos su link
        //$query="UPDATE eventos SET url = '$link' WHERE id = $id";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->route('consultas.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $consulta = Consulta::findOrFail($id);
            $consulta->cliente_id = $request->cliente_id;
            $consulta->peso = $request->peso;
            $consulta->comentario = $request->comentario;
            $consulta->save();
            return response()->json($consulta);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Cambia el campo asistio
     */
    public function changeAsistencia() 
    {
        $id = Input::get('id');

        $consulta =Consulta::findOrFail($id);
        $consulta->asistio = !$consulta->asistio;
        $consulta->save();

        return response()->json($consulta);
    }
}
