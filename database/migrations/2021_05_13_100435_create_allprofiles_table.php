<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allprofiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('detail')->nullable();
            $table->string('title')->nullable();
            $table->string('img')->nullable();
            $table->string('parth')->nullable();
            $table->unsignedBigInteger("userid");
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('allprofiles');
    }
}
