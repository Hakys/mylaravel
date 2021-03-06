<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Cliente;
use App\Consulta;
use View;
use Carbon\Carbon;

class ClienteController extends Controller{

    protected $rules = [        
        'full_name' => 'min:2|max:190|string',
        'peso_inicial' => 'numeric',
        'peso_saludable' => 'numeric',
        'altura' => 'numeric',
        'f_nacimiento' => 'date',
        'telefono' => 'required|numeric',
        'email' => 'required|email',
        //'fecha' => 'date',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::orderByDesc('created_at')->get();
        return view('clientes.index', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */ 
    public function create() 
    {
        return redirect()->route('clientes.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $cliente = new Cliente();
            $cliente->full_name = $request->full_name;
            $cliente->peso_inicial = $request->peso_inicial;
            $cliente->peso_saludable = $request->peso_saludable;
            $cliente->altura = $request->altura;
            $cliente->f_nacimiento = $request->f_nacimiento;
            $cliente->telefono = $request->telefono;
            $cliente->email = $request->email;
            $cliente->anotaciones = $request->anotaciones;
            $cliente->save();
            //$cliente->consultas()->save($consulta0);

            $consulta0 = new Consulta();
            $consulta0->fecha = $cliente->created_at;
            $consulta0->start = $cliente->created_at->timestamp*1000;
            $consulta0->peso = $request->peso_inicial;
            $consulta0->comentario = 'consulta inicial';
            $consulta0->asistio = 1;
            $consulta0->cliente_id = $cliente->id;
            $consulta0->save();

            $consultafinal = new Consulta();
            $consultafinal->fecha = $cliente->created_at->copy()->addYear();
            $consultafinal->start = $consultafinal->fecha->timestamp*1000;
            $consultafinal->peso = $request->peso_saludable;
            $consultafinal->comentario = 'peso esperado';
            $consultafinal->asistio = 0;
            $consultafinal->cliente_id = $cliente->id;
            $consultafinal->save();
            
            return response()->json($cliente);
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
        $cliente = Cliente::findOrFail($id);
        //$consultas = Consulta::where('cliente_id', $id)->orderByDesc('fecha')->get();
        return view('clientes.show', [
            'cliente' => $cliente,
            'consultas' => $cliente->consultas()->orderbyDesc('fecha')->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->route('clientes.index');
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
            $cliente = Cliente::findOrFail($id);
            $cliente->full_name = $request->full_name;
            $cliente->peso_inicial = $request->peso_inicial;
            $cliente->peso_saludable = $request->peso_saludable;
            $cliente->altura = $request->altura;
            $cliente->f_nacimiento = $request->f_nacimiento;
            $cliente->telefono = $request->telefono;
            $cliente->email = $request->email;
            $cliente->anotaciones = $request->anotaciones;
            $cliente->update();
            return response()->json($cliente);
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
        $cliente = Cliente::findOrFail($id);
        $cliente->consultas()->delete();
        $cliente->delete();
        return response()->json($cliente);
    }

    /**
     * Cambia el campo activo
     */
    public function changeStatus() 
    {
        $id = Input::get('id');

        $cliente = Cliente::findOrFail($id);
        $cliente->activo = !$cliente->activo;
        $cliente->save();

        return response()->json($cliente);
    }
}
