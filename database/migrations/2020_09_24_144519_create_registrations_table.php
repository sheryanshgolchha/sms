<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->increments('reg_id');
            $table->string('fname',15);
            $table->string('lname',15);
            $table->string('email',255);
            $table->string('password',255);
            $table->string('phone',10);
            $table->string('id_proof',50);
            $table->string('photo',50);
            $table->integer('wing_id');
            $table->integer('flat_no');
            $table->integer('category')->nullable();
            $table->integer('status')->nullable();
            $table->string('last_login_time',18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
