<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //protected $connection = 'farma';
    protected $table ="clientes";
    protected $primaryKey ="id";
    protected $fillable=['apaterno,amaterno,nombre,ci,nit,telefono,tipo_cliente'];
}
