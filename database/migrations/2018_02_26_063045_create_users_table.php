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
            $table->string('email')->comment('邮箱');
            $table->string('phone')->comment('手机号码');
            $table->string('city')->comment('城市');
            $table->string('avatar')->comment('头像地址');
            $table->enum('sex',['男','女'])->default('男')->comment('性别');
            $table->string('sign')->comment('个人签名');
            $table->tinyInteger('todaySignReward')->default('0')->comment('本次签到获得的积分');
            $table->tinyInteger('reward')->default('0')->comment('总积分');
            $table->time('last_sign_time')->comment('上次签到时间');
            $table->tinyInteger('total_sign_day')->default(0)->comment('累计签到天数');
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
