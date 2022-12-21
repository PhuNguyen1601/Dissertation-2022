<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichthiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lichthi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ngayid')->unsigned()->nullable();
            $table->integer('gioid')->unsigned()->nullable();
            $table->integer('phongid')->unsigned()->nullable();
            $table->integer('lhpid')->unsigned()->nullable();
            $table->boolean('type')->default(0);
            $table->string('video')->default('0');
            $table->string('videodec')->default('0');
            $table->timestamps();
            $table->foreign('ngayid')->references('id')->on('ngay')->onDelete('cascade');
            $table->foreign('gioid')->references('id')->on('gio')->onDelete('cascade');
            $table->foreign('phongid')->references('id')->on('phong')->onDelete('cascade');
            $table->foreign('lhpid')->references('id')->on('lophocphan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lichthi');
    }
}