<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model{

    protected $table = 'consultas';
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = ['created_at', 'peso', 'variacion', 'comentario', 'asistio', 'fecha'];
    protected $hidden = ['id', 'updated_at'];
    protected $dates = ['created_at', 'updated_at','fecha'];
    
    // One to Many
    public function cliente(){ 
        return $this->belongsTo('App\Cliente','id_cliente');
    }
}
