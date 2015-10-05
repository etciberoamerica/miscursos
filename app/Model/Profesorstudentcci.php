<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

class Profesorstudentcci extends Model
{
    protected  $connection='sqlsrv_four';
    protected   $table='Ctrl_ProfessorStudents';
    public $timestamps = false;
}
