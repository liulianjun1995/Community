<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zans', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->tinyInteger('user_id')->comment('点赞人');
            $table->tinyInteger('comment_id')->comment('点赞的评论');
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
        Schema::dropIfExists('zans');
    }
}
