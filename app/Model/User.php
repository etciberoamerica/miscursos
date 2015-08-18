<?php

namespace misCursos\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dbo.mc_users';
    public $timestamps = true;

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
}
