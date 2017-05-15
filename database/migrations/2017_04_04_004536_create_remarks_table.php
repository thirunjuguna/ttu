<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remarks',function(Blueprint $table){
            $table->increments('id');
            $table->string('record');
            $table->LongText('remark');
            $table->Integer('price')
                    ->default(0);
            $table->string('dp');
            $table->string('minidp');
            $table->string('status');
            $table->string('year')->default('');
            $table->string('reg')->default('');
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
        Schema::drop('remarks');
    }
}
