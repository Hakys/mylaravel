<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Cliente;
use App\Consulta;
use View;

class ClienteController extends Controller{

    protected $rules = [        
        'full_name' => 'required|min:2|max:190|string',
        'peso_inicial' => 'required|numeric',
        'peso_saludable' => 'required|numeric',
        'altura' => 'required|numeric',
        'f_nacimiento' => 'required|date',
        'telefono' => 'required|numeric',
        'email' => 'required|email',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $clientes = Cliente::orderByDesc('created_at')->get();
        return view('clientes.index', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */ 
    public function create() {
        return redirect()->route('clientes.index');
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

            $consulta0 = Consulta::where('asistio',0)->where('fecha','>',TODAY())->orderby('fecha')->first();
            $consulta0->id_cliente = $cliente->id;
            $consulta0->peso = $cliente->peso_inicial;
            $consulta0->comentario = 'consulta inicial';
            $consulta0->asistio = 1;
            $consulta0->save();
            return response()->json($cliente);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $cliente = Cliente::findOrFail($id);
        $consultas = Consulta::where('id_cliente', $id)->orderByDesc('fecha')->get();
        return view('clientes.show', 
            ['cliente' => $cliente,'consultas' => $consultas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        return redirect()->route('clientes.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
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
            $cliente->save();
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
