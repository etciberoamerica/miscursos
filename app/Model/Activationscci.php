<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

class Activationscci extends Model
{
    protected  $connection='sqlsrv_four';
    protected   $table='Ctrl_Activations';
    public $timestamps = false;
}
