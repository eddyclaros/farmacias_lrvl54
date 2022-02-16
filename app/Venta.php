<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table= 'ventas';
    protected $fillable=['num_documento','tipodocumento','idprestacion','iddescuento','monto_cancelado','idcliente','idusuario'];
}
