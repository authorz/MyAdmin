<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolepermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # 角色权限绑定表
        Schema::create('rolepermissions', function (Blueprint $table) {
            $table->integer('RoleId')->comment('角色ID');
            $table->integer('PermissionID')->comment('权限ID');
            $table->integer('AssignmentDate');

            $table->primary(['RoleId', 'PermissionID']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rolepermissions');
    }
}
