<?php

namespace misCursos\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use DB;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mc_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'institution_id',
            'user_name',
            'name',
            'last_name',
            'last_name_m',
            'country_id',
            'state_id',
            'city',
            'location',
            'geneder',
            'birth_date',
            'email',
            'password',
            'actived',
            'rol_id',
            'gmetrix_id',
            'ciidte_id',
            'moac_id',
            'tts_id',
            'sci_id'
    ];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public static  function execProcedure(array $data){
        if($data['Genero'] =='M'){
            $genero="Masculino";
        }else{
            $genero='Femenino';
        }
        $telefono =12345678;
        try{
            $res= DB::connection('')->select('EXEC creausuarioTemp ?,?,?,?,?,?,?,?,?,?',
                array($data['Email'],
                    bcrypt($data['Password']),
                    $data['Email'],
                    $data['ciidte_id'],
                    $data['moac_id'],
                    $data['Nombre'],
                    $data['Apellido_Paterno'],
                    $data['Apellido_Materno'],
                    $data['tts_id'],
                    $data['Institución']));
        }catch (\Exception $e){
            $e->getMessage();
            abort('410','Update');
        }

    }

    public static function teeeeeo(){

    }
}
