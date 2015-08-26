<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'group_id'         
        ,'key'
        ,'gruop_institution'
        ,'description'
    ];

    protected $table = 'mc_groups';
}
