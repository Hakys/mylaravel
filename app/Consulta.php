<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model{

    protected $table = 'consultas';
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = ['peso', 'comentario'];
    protected $hidden = ['id', 'created_at', 'updated_at'];

    public function clientesUnion(){
		    return $this->belongsTo('Cliente','id');
	  }
}
