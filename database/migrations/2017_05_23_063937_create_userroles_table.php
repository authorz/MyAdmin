<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserrolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # 用户角色绑定表
        Schema::create('userroles', function (Blueprint $table) {
            $table->integer('UserId')->comment('用户ID');
            $table->integer('RoleId')->comment('角色ID');
            $table->integer('AssignmentDate');

            $table->primary(['UserId', 'RoleId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userroles');
    }
}
