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
            $table->string('last_name')->nullable();
            $table->string('last_name_m')->nullable();
            $table->integer('country_id')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->string('city')->nullable();
            $table->string('location')->nullable();
            $table->enum('geneder',['M','F'])->nullable();;
            $table->dateTime('birth_date')->nullable();
            $table->string('email')->nullable();
            $table->string('password', 60);
            $table->boolean('actived')->default('1');
            $table->integer('rol_id')->default('1');
            $table->rememberToken();
            $table->dateTimeTz('created_at')->nullable();
            $table->dateTimeTz('updated_at')->nullable();
            //$table->timestamps();
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
