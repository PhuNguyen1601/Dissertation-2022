<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLophocphanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lophocphan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('malhp');
            $table->integer('hkid')->unsigned()->nullable();
            $table->integer('nkid')->unsigned()->nullable();
            $table->integer('hpid')->unsigned()->nullable();
            $table->integer('gvid')->unsigned()->nullable();
            $table->string('tgthi');
            $table->boolean('type')->default(0);
            $table->boolean('dangki')->default(0);
            $table->foreign('hkid')->references('id')->on('hocki')->onDelete('cascade');
            $table->foreign('gvid')->references('id')->on('giangvien')->onDelete('cascade');
            $table->foreign('nkid')->references('id')->on('nienkhoa')->onDelete('cascade');
            $table->foreign('hpid')->references('id')->on('hocphan')->onDelete('cascade');
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
        Schema::dropIfExists('lophocphan');
    }
}