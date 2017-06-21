<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoclassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # 栏目表
        Schema::create('infoclass', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Type');
            $table->string('Title', 55)->comment('栏目标题');
            $table->string('img', 255)->nullable()->comment('缩略图');
            $table->string('width', 10)->nullable()->comment('缩略图宽度');
            $table->string('height', 10)->nullable()->comment('缩略图高度');
            $table->string('jumpurl', 255)->nullable()->comment('跳转链接');
            $table->string('seo', 255)->nullable()->comment('seo标题');
            $table->string('keywords', 255)->nullable()->comment('关键字');
            $table->text('description')->nullable()->comment('栏目描述');
            $table->integer('sort')->default(0)->comment('排序');
            $table->tinyInteger('hide')->default(0)->comment('是否隐藏 0=>显示 1=>隐藏');

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
        Schema::dropIfExists('infoclass');
    }
}
