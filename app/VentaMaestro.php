<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaMaestro extends Model
{
    //protected $table = 'venta_maestros';
    protected $fillable=['num_documento','tipodocumento','idcliente','total','efectivo','cambio'];
}
