<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->uinque();
            $table->string('password');
            $table->string('email');
            $table->string('city')->comment('城市');
            $table->string('avatar')->comment('头像');
            $table->enum('sex',['男','女'])->default('男');
            $table->string('sign')->comment('个人签名');
            $table->tinyInteger('reward')->default('0');
            $table->char('is_signed')->default('0')->comment('是否已签到');
            $table->time('last_sing_time')->comment('上次签到时间');
            $table->time('sing_time')->comment('签到时间');
            $table->tinyInteger('sing_day')->default(0)->comment('累计签到天数');
            $table->string('remember_token');
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
        Schema::dropIfExists('users');
    }
}
