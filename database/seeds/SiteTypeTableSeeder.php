<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sitetype')->insert([
            ['Name' => '字符串'],
            ['Name' => '文本'],
            ['Name' => '密码'],
            ['Name' => '单选按钮'],
            ['Name' => '复选框'],
            ['Name' => '下拉框'],
            ['Name' => '日期'],
            ['Name' => '时间'],
            ['Name' => '标签'],
            ['Name' => '文件'],
            ['Name' => '编辑器']
        ]);
    }
}
