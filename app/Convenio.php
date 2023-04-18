<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    protected $fillable = [
        'nome', 'codigo'
    ];


    public function gastos()
    {
        return $this->hasMany('App\GastosUsuario', 'codigo', 'convenio');
    }
}
