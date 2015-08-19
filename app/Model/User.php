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
            'rol_id'];

    /*
     * array(
     * 'institution_id' => '472',
     * 'name' => 'sss',
     * 'last_name' => 'ssssss',
     * 'last_name_m' => 'rrrrrrrrrrrrr',
     * 'country_id' => '57',
     * 'state_id' => '0',
     * 'city' => 'sss', 'location' => 'rrrrrrrrrr',
     * 'geneder' => 'M',
     * 'birth_date' => '17/07/2015',
     * 'email' => 'etc@etc.com',
     * 'password' => '$2y$10$Vqz.De1N/ZkU.c8xgA7UUurfvhaPpOodvrzGWWw4WEpdosmfvguDu',
     * 'rol_id' => '1')
     */

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public static  function execProcedure(array $data){
        /*
         * EXEC creausuarioTemp'".$login_usuario."','".$contra."','".$email_usuario."','".$campo."','".$idNewS."','".$nombre_usuario." ".$appaterno_usuario." ".$apmaterno_usuario."','".$idTTS."','".$institucion_id."'"
         */

        //$idNewS = $data['moac_id'];
        //$campo = $data['ciidte_id'];
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


        }catch (ValidationException $e){
            $e->getError();
            abort('410','Update');
        }





    }
}
