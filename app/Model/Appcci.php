<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

class Appcci extends Model
{
    protected  $connection='sqlsrv_four';
    protected   $table='Cat_Apps';
    public $timestamps = false;
}
