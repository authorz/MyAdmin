<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # 超级管理员数据
        DB::table('user')->insert([
            'Name' => 'admin',
            'Email' => 'admin@admin.com',
            'PassWord' => Hash::make('admin'),
            'LoginTime' => date('Y-m-d H:i:s', time())
        ]);
    }
}
