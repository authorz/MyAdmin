<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteclassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # 自定义菜单
        Schema::create('siteclass', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Name', 55)->comment('菜单名称');
            $table->tinyInteger('Show')->default(0)->comment('显示状态 0=>显示 1=>隐藏');
            $table->integer('Sort')->default(0)->comment('排序');

            $table->unique('Name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siteclass');
    }
}
