<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        #　默认配置
        Schema::create('site', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('TypeId')->comment('类型ID');
            $table->string('Name', 55)->comment('配置名称');
            $table->string('Title', 55)->comment('配置别名');
            $table->string('Default', 55)->comment('默认配置');
            $table->integer('BindClass')->default(0)->comment('绑定的配置菜单 0=>不绑定任何配置菜单');
            $table->text('Value')->comment('配置内容');
            $table->integer('Sort')->comment('排序');

            $table->unique('Name');
            $table->unique('Title');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site');
    }
}
