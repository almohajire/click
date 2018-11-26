<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_user', function (Blueprint $table) {
            $table->increments('id');

            $table->softDeletes();

            $table->integer('user_id')->index()->insigned();
            $table->integer('link_id')->index()->insigned();
            

            $table->string('codegen');


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
        Schema::dropIfExists('table_link_user');
    }
}
