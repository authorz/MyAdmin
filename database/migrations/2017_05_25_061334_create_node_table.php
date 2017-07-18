<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateNodeTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            # 节点表
            Schema::create('node', function (Blueprint $table) {
                $table->increments('Id');
                $table->string('NodeName', 25)->comment('节点名称');
                $table->string('Icon', 25)->comment('节点图标');
                $table->integer('Pid');
                $table->integer('Sort')->comment('排序');
                $table->string('Href', 125)->comment('地址');
                $table->tinyInteger('State')->comment('0=>正常 1=>禁用')->default(0);
                $table->integer('Module')->comment('绑定的模块')->default(0);

                $table->index(['NodeName', 'Pid', 'Href']);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('node');
        }
    }
