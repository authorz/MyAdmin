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
                $table->string('title')->default('')->comment('文章标题');
                $table->string('style')->default('')->comment('属性');
                $table->string('source')->nullable()->comment('文章来源');
                $table->string('author')->nullable()->comment('作者');
                $table->string('picurl')->nullable()->comment('缩略图');
                $table->string('linkurl')->nullable()->comment('跳转链接');
                $table->string('keywords')->nullable()->comment('关键字');
                $table->string('description')->nullable()->comment('摘要');
                $table->text('content')->nullable()->comment('详细内容');
                $table->string('picarr')->nullable()->comment('组图');
                $table->integer('click')->default(0)->comment('点击次数');
                $table->integer('sort')->default(9999)->comment('排序');
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
