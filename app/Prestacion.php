<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestacion extends Model
{
    protected $table ="prestacions";
    protected $fillable=['nombre','precio','descripcion','codigo','correlativo'];
}
