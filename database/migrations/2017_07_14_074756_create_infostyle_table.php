<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateInfostyleTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('infostyle', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->comment('属性名称');
                $table->integer('sort')->comment('排序');

                $table->index('name');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('infostyle');
        }
    }
