<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticulosController extends Controller{
    public function ver($id){
        return view('articulos.ver', ['id' => $id]);
        }
    
    public function vertodos(){
        dd(\App\Article::all());
        }
        
    public function recibirPost(Request $request, $id){
        echo $request->path();echo "<br>";
        echo $request->url();echo "<br>";
        echo $request->input('id');echo "<br>";
        echo "Recibo $id como parámetro de la ruta.";echo "<br>";
        echo "Además recibimos estos datos por formulario: " . implode(', ', $request->all());
        $todos_los_datos = $request->all();
        echo dd($todos_los_datos);echo "<br>";
        }

    public function recibir(Request $request){
        $metodo = $request->method();
        if($request->isMethod('post')){
            echo "Estoy recibiendo por post";
            $nombre = $request->input("nombre");
            $edad = $request->input("edad", 18);    #valor defecto

        }
            
    }
        
    }
