<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # 栏目分类
        Schema::create('maintype', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Pid')->default(0)->comment('0=>顶级 1=>二级或更高');
            $table->string('Name', 55)->comment('类别名称');
            $table->integer('Sort')->default(0)->comment('排序');
            $table->tinyInteger('Show')->default(0)->comment('0=>显示 1=>隐藏');

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
        Schema::dropIfExists('maintype');
    }
}
