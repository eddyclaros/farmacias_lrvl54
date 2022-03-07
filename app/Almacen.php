<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $fillable= ['tipo','razon_social','telefonos','nit','direccion','ciudad'];
}
