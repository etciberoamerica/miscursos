<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

class Ordermoac extends Model
{
    protected $connection = 'sqlsrv_two';
    protected $table = 'ORDER_MOAC';

    protected $fillable = [
        'id'
        ,'id_testing_center_school_cycle'
        ,'id_license'
        ,'id_version'
        ,'id_language'
        ,'date_limit'
        ,'quantity'
        ,'active'
        ,'dateadd'
        ,'datemodify'
    ];
}
