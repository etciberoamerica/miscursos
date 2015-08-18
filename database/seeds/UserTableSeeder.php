<?php

use Illuminate\Database\Seeder;
use misCursos\Model\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $this->createUser();
    }


    private function createUser(){
        User::create([
            'name'   =>   'p1@etc.com',
            'email'   =>   'p1@etc.com',
            'last_name' => 'p1@etc.com',
            'password' =>  bcrypt('123456'),
            'institution_id' => 1,
            'country_id' =>1,
            'state_id' => 1,
            'rol_id' => 1

        ]);

        User::create([
            'name'   =>   'p2@etc.com',
            'email'   =>   'p2@etc.com',
            'password' =>  bcrypt('123456'),
            'institution_id' => 1,
            'country_id' =>1,
            'state_id' =>1,
            'rol_id' => 2


        ]);

        User::create([
            'name'   =>   'p3@etc.com',
            'email'   =>   'p3@etc.com',
            'password' =>  bcrypt('123456'),
            'institution_id' => 1,
            'country_id' =>1,
            'state_id' =>1,
            'rol_id' => 3


        ]);


    }


}