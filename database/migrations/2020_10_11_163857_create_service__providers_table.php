<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service__providers', function (Blueprint $table) {
            $table->increments('service_provider_id');
            $table->integer('service_id');
            $table->string('name',30);
            $table->string('phone',10);
            $table->string('photo',50);
            $table->string('address',80);
            $table->string('id_proof',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service__providers');
    }
}
