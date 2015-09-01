<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mc_groups',function(Blueprint $table){
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->string('key');
            $table->string('gruop_institution');
            $table->string('description');
            $table->integer('user_id');
            $table->boolean('actived')->default('1');
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
        Schema::drop('mc_groups');
    }
}
