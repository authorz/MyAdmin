<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # 管理员表
        Schema::create('user', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('Name', 55)->comment('登录用户名');
            $table->string('Email', 55)->nullable()->comment('登录邮箱');
            $table->string('PassWord', 255)->comment('登录密码');
            $table->dateTime('LoginTime')->comment('登录时间');
            $table->tinyInteger('State')->comment('0=>正常 1=>禁用')->default(0);

            $table->unique('Name', 'Name');
            $table->unique('Email', 'Email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
