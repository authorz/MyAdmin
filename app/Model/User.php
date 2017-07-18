<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Mockery\CountValidator\Exception;

class User extends Model
{
    protected $table = 'user';

    public $primaryKey = 'ID';

    public $timestamps = false;

    // 验证用户名是否正确
    public function validationUserName($username)
    {
        $output = self::where('Name', $username)->count();

        return $output;
    }

    // 验证邮箱是否正确
    public function validationEmail($email)
    {
        $output = self::where('Email', $email)->count();

        return $output;
    }

    // 验证密码
    public function validationPass($username, $password)
    {
        $sqlPassWord = self::where('Name', $username)->value('PassWord');

        if (Hash::check($password, $sqlPassWord)) {
            return true;
        } else {
            return false;
        }

    }

    public static function userNameWithId(string $username) : int
    {
        $userId = self::where('Name', $username)->value('ID');

        return $userId;
    }

    // 修改邮箱
    public function modifyEmail($email)
    {
        $output = self::where('Name', Session::get('UserLoginData.username'))->update(['Email' => $email]);

        return $output;
    }

    // 获取邮箱
    public function getEmail()
    {
        $output = self::where('Name', Session::get('UserLoginData.username'))->value('Email');

        return $output;
    }

    // 启用用户
    public function enableUser($id)
    {
        $output = self::where('ID', $id)->update(['State' => 0]);

        return $output;
    }

    // 禁用用户
    public function disableUser($id)
    {
        $output = self::where('ID', $id)->update(['State' => 1]);

        return $output;
    }

    // 删除用户
    public function deleteUser($id)
    {
        $output = self::where('ID', $id)->delete();

        return $output;
    }

    // 获取用户信息
    public function getUser($id)
    {
        $output = self::where('ID', $id)->first()->toArray();

        if (!$output) {
            throw new Exception('用户不存在');
        }

        return $output;
    }

}
