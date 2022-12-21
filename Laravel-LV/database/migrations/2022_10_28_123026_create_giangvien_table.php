<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiangvienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giangvien', function (Blueprint $table) {
            $table->increments('id');
            $table->string('magv');
            $table->string('tengv');
            $table->string('email');
            $table->string('password');
            $table->date('ngaysinh');
            $table->boolean('type')->default(0);
            $table->integer('bmid')->unsigned()->nullable();
            $table->foreign('bmid')->references('id')->on('bomon')->onDelete('cascade');
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
        Schema::dropIfExists('giangvien');
    }
}