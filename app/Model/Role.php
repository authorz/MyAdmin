<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    public $primaryKey = 'ID';

    public $timestamps = false;

    // 获得所有角色
    public function getRole()
    {
        $tree = [];

        $output = self::all();

        foreach ($output as $key => $value) {
            $tree[$value->ID] = $value->Title;
        }

        return $tree;
    }


    // 获取指定角色信息
    public function getThisRole($roleId) : array
    {
        $output = self::where('ID', $roleId)->first()->toArray();

        return $output;
    }

}
