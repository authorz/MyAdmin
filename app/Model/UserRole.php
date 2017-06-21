<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'userroles';

    public $timestamps = false;

    // 绑定角色
    public function bindRole(int $userId, int $roleId) : bool
    {
        $count = self::where('UserId', $userId)->count();

        if ($count) {
            $result = self::where('UserId', $userId)->update([
                'RoleId' => $roleId
            ]);

            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            $this->UserId = $userId;
            $this->RoleId = $roleId;
            $this->AssignmentDate = time();

            if ($this->save()) {
                return true;
            } else {
                return false;
            }
        }

    }

    // 获取绑定角色
    public function getBindRole(int $userId) : int
    {
        $roleId = self::where('UserId', $userId)->first();
        if ($roleId) {
            return $roleId->toArray()['RoleId'];
        } else {
            return 0;
        }
    }
}
