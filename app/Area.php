<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table ="areas";
    //protected $primaryKey ="id";
    protected $fillable= ['codigo','correlativo','nonmbre','descripcion'];

}
