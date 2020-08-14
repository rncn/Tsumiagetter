<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsumiagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tsumiages', function (Blueprint $table) {
            $table->id();
            $table->integer('pfolder_id')->unsigned();
            $table->string('name');
            $table->integer('user_id')->unsigned();
            $table->boolean('isprivate');
            $table->boolean('iscompleted')->nullable();
            $table->timestamps();
            $table->foreign('pfolder_id')->references('id')->on('folders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tsumiages');
    }
}
