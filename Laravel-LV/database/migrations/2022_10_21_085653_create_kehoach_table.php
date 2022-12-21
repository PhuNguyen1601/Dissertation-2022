<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKehoachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kehoach', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tieude');
            $table->date('ngaybd_dk');
            $table->date('ngaykt_dk');
            $table->date('ngaybd_thi');
            $table->date('ngaykt_thi');
            $table->boolean('type')->default(0);
            $table->integer('nkid')->unsigned()->nullable();
            $table->integer('hkid')->unsigned()->nullable();
            $table->foreign('nkid')->references('id')->on('nienkhoa')->onDelete('cascade');
            $table->foreign('hkid')->references('id')->on('hocki')->onDelete('cascade');
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
        Schema::dropIfExists('kehoach');
    }
}