<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model {
    
    protected $table = 'clientes';
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = ['full_name', 'peso', 'f_nacimiento', 'activo', 'email', 'telefono', 'anotaciones', ];
    protected $hidden = ['id', 'created_at', 'updated_at'];

    // Relación
    public function consultas(){
        return $this->hasMany('App\Consulta');
    }

    public function consultasUnion(){
		return $this->hasMany('Consulta','id_cliente');
	}

    public static function getExcerpt($str, $startPos = 0, $maxLength = 50) {
        if(strlen($str) > $maxLength) {
            $excerpt   = substr($str, $startPos, $maxLength - 6);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt   = substr($excerpt, 0, $lastSpace);
            $excerpt  .= ' [...]';
        } else {
            $excerpt = $str;
        }

        return $excerpt;
    }

}
