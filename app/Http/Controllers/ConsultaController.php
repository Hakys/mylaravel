<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Consulta;
use App\Cliente;
use View;

class ConsultaController extends Controller
{
    protected $rules = [        
        'id_cliente' => 'required|numeric',
        'peso' => 'required|numeric',
    ];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultas = Consulta::orderByDesc('created_at')->get();
        $clientes = Cliente::orderBy('full_name')->get();
        return view('consultas.index', ['consultas' => $consultas,'clientes' => $clientes]);
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
}
