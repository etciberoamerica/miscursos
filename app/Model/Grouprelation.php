<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

class Grouprelation extends Model
{
    protected $fillable = [
        'group_id'
        ,'ciidte_group_id'
        ,'moac_group_id'
        ,'producto_id'
        ,'actived'
    ];

    protected $table = 'mc_groups_relation';

    public function group(){
        return $this->hasMany('Model\Group','group_id','id');
    }
}
