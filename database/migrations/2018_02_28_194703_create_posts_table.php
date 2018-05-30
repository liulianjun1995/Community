<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->tinyInteger('user_id')->comment('帖子所属人');
            $table->tinyInteger('category_id')->comment('帖子所属板块');
            $table->string('title')->comment('帖子标题');
            $table->text('content')->comment('帖子内容');
            $table->tinyInteger('is_closed')->default(0)->comment('是否结贴');
            $table->tinyInteger('is_sticky')->default(0)->comment('是否加精');
            $table->tinyInteger('is_top')->default(0)->comment('是否置顶');
            $table->tinyInteger('status')->default(0)->comment('帖子状态');
            $table->tinyInteger('reward')->comment('悬赏');
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
        Schema::dropIfExists('posts');
    }
}
