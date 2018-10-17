<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Consulta;
use App\Cliente;
use View;

class ConsultaController extends Controller{
    protected $rules = [        
        'peso' => 'numeric',
        'variacion' => 'numeric',
        'id_cliente' => 'numeric',
        'asistio' => 'boolean',
        'comentario' => 'string',
        'fecha' => 'requered|date',
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
    
    public function diario($ano,$mes,$dia){
        $consultas = Consulta::where('fecha', '>=', date('Y-m-d',mktime(0,0,0,$mes,$dia,$ano)))
                            ->where('fecha', '<', date('Y-m-d',mktime(0,0,0,$mes,$dia+1,$ano)))
                            ->orderBy('fecha')->get();
        $clientes = Cliente::all();
        return view('consultas.diario', [
            'ano' => $ano, 'mes' => $mes, 'dia' => $dia,
            'consultas' => $consultas,'clientes' => $clientes]);
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
            $consulta->id_cliente = $request->id_cliente;
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
            $consulta->id_cliente = $request->id_cliente;
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
