<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memos', function (Blueprint $table) {
            $table->bigIncrements('memo_id');
            $table->string('title');
            $table->string('text');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('folder_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('folder_id')->references('folder_id')->on('folders');
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
        Schema::dropIfExists('memos');
    }
}
