<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::create('users', function (Blueprint $table) {

            //$table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('number_click')->unsigned()->default(0);
            $table->float('points')->unsigned()->default(0);
            $table->integer('number_clicked')->unsigned()->default(0);
            $table->booloan('in_need')->default(false);
            $table->tinyInteger('role')->unsigned()->default(0);
            $table->tinyInteger('color')->unsigned()->default(0);
            $table->boolean('shorten_open')->default(true);
            $table->string('shorten_url')->default('https://bitly.com');
            $table->float('credit_add')->unsigned()->default(0);
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
        Schema::dropIfExists('users');
    }
}
