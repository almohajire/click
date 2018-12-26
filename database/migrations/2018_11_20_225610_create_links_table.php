<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {

            //$table->engine = 'InnoDB';


            $table->increments('id');
            $table->string('link')->unique();
            $table->integer('clicked')->default(0);
            $table->boolean('confirmed')->default(false);
            $table->string('hash')->unique();
            $table->tinyInteger('level')->insigned()->default(0);
            //$table->string('ip');
            $table->integer('user_id')->index()->insigned();



            
            /*
            $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
            */

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
        Schema::dropIfExists('links');
    }
}
