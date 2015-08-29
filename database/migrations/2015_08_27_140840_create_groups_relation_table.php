<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mc_groups_relation',function (Blueprint $table){
            $table->increments('id');
            $table->integer('group_id');
            $table->integer('ciidte_group_id')->nullable();
            $table->integer('moac_group_id')->nullable();
            $table->integer('producto_id');
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
        Schema::drop('mc_groups_relation');
    }
}
