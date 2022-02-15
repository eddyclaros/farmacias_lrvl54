<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $connection = 'farma';
    protected $table ="persona";
    protected $primaryKey ="id_persona";
}
