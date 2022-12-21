<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSvLhpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lophocphan_sinhvien', function (Blueprint $table) {
            $table->integer('lophocphan_id')->unsigned()->nullable();
            $table->integer('sinhvien_id')->unsigned()->nullable();
            $table->boolean('type')->default(0);

            $table->foreign('sinhvien_id')->references('id')->on('sinhvien')->onDelete('cascade');
            $table->foreign('lophocphan_id')->references('id')->on('lophocphan')->onDelete('cascade');
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
        Schema::dropIfExists('lophocphan_sinhvien');
    }
}