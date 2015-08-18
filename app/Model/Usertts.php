<?php

namespace misCursos\Model;

use Illuminate\Database\Eloquent\Model;

class Usertts extends Model
{
    protected $connection = 'sqlsrv_three';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'STUDENT_GM';

    public $timestamps = false;

    protected $fillable = [
        'id_country' ,
        'id_state',
        'active'  ,
        'first_name',
        'last_name' ,
        'birthday' ,
        'city'   ,
        'email',
        'password',
        'secret_question',
        'secret_answer'];

    public static function getData(array $data){
       return Usertts::where('email',$data['Email'])->first();
    }

}
