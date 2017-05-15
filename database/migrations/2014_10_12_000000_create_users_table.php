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
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('mobile')->default('');
            $table->string('reg')
                     ->default('');
            $table->string('password');
            $table->string('department')
                     ->default('');
            $table->string('course')
                     ->default('');
              $table->string('minidp')
                     ->default('');
            $table->string('yos')
                    ->default('');
            $table->string('level');
            $table->integer('balance')->default(0);
            $table->string('verify_code')->default('');
            $table->integer('verify_status')->default(0);
            $table->integer('status')->default(1);
            $table->integer('complete')->default(0);
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
