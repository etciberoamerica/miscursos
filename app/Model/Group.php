<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

use misCursos\Model\Grouprelation;

class Group extends Model
{
    protected $fillable = [
        'group_id'
        ,'key'
        ,'gruop_institution'
        ,'description'
        ,'created_at'
    ];

    protected $table = 'mc_groups';


    public function grouprelation()
    {
        return $this->belongsTo('misCursos\Model\Grouprelation','mc_groups_relation');
        //return $this->hasMany('App\Task');
    }
}
