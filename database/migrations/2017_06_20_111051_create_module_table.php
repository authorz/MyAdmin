<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateModuleTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            # 创建模块表
            Schema::create('module', function (Blueprint $table) {
                $table->increments('Id');
                $table->string('ModuleName', 55)->comment('模块名称');
                $table->string('Title', 55)->comment('模块简介');
                $table->string('Author', 55)->comment('作者');
                $table->text('Description')->nullable()->comment('模块描述');
                $table->string('Icon', 55)->default('')->comment('模块图标');
                $table->tinyInteger('Type')->default(0)->comment('状态 0=>启用 1=>禁用');
                $table->dateTime('InstallTime')->comment('安装时间');

                $table->unique(['ModuleName']);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('module');
        }
    }
