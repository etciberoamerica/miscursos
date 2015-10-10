<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;


class Licensmoac extends Model
{
    protected $connection = 'sqlsrv_two';
    protected $table = 'LICENSES_MOAC';
}
