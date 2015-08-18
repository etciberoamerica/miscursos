<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

class Usermoac extends Model
{

    protected $connection = 'sqlsrv_two';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'STUDENT_MOAC';
}
