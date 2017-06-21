<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # 角色表
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('Pid');

            $table->string('Title', 128)->comment('角色名称');
            $table->text('Description')->comment('角色描述');

            $table->index('Title');
            $table->index('Pid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
