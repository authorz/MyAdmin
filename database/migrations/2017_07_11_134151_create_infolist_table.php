<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateInfolistTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('infolist', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('classId')->comment('所属栏目');
                $table->string('title')->comment('文章标题');
                $table->string('style')->comment('属性');
                $table->string('source')->comment('文章来源');
                $table->string('author')->comment('作者');
                $table->string('picurl')->default('')->comment('缩略图');
                $table->string('linkurl')->default('')->comment('跳转链接');
                $table->string('keywords')->default('')->comment('关键字');
                $table->string('description')->default('')->comment('摘要');
                $table->text('content')->comment('详细内容');
                $table->string('picarr')->default('')->comment('组图');
                $table->integer('click')->comment('点击次数');
                $table->integer('sort')->comment('排序');
                $table->tinyInteger('check')->default(1)->comment('是否审核 0=>审核成功 1=>未审核');
                $table->timestamps();

                $table->index(['title', 'style', 'keywords', 'sort']);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('infolist');
        }
    }
