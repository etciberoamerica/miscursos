<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mc_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institution_id')->unsigned();
            $table->string('name');
            $table->string('last_name');
            $table->string('last_name_m');
            $table->integer('country_id')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->string('city');
            $table->string('location');
            $table->enum('geneder',['M','F']);
            $table->dateTime('birth_date');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->boolean('actived')->default('1');
            $table->integer('rol_id')->default('1');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mc_users');
    }
}
