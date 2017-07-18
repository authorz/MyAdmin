<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateThemeTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            # 主题表
            Schema::create('theme', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->comment('名称');
                $table->string('alias')->comment('别名');
                $table->string('path')->comment('css路径');
                $table->tinyInteger('type')->default(0)->comment('主题类型 0=>全局 1=>头部 2=>导航');
                $table->integer('sort');
                $table->integer('time');

            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('theme');
        }
    }
