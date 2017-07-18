<?php
namespace App\Http\Controllers\Auth;

use App\Model\LoginLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    // 验证方法
    public function validation(Request $request, User $userModel, LoginLog $loginLog)
    {
        $loginUserName = $request->input('login-username');

        $loginPassWord = $request->input('login-password');


        $hasUserName = $userModel->validationUserName($loginUserName);

        if ($hasUserName == 0) {
            return response()->json(['message' => '用户名不存在', 'code' => 0, 'return' => []]);
        }

        $result = $userModel->validationPass($loginUserName, $loginPassWord);

        if ($result) {

            $loginRemember = $request->input('login-remember-me') ?? false;

            $this->setUpUserLoginData($loginUserName);

            if ($loginRemember) {

                $cookieUserName = Cookie::forever('loginUserName', $loginUserName);
                $cookieRemember = Cookie::forever('loginRemember', $loginRemember);
                $cookiePassWord = Cookie::forever('loginPassWord', $loginPassWord);

                $loginLog->recordLog($loginUserName, $request->getClientIp());

                return response()->json(['message' => '登录成功', 'code' => 200, 'return' => []])
                    ->cookie($cookieRemember)
                    ->cookie($cookiePassWord)
                    ->cookie($cookieUserName);
            } else {

                $cookieUserName = Cookie::forget('loginUserName');
                $cookieRemember = Cookie::forget('loginRemember');
                $cookiePassWord = Cookie::forget('loginPassWord');

                return response()->json(['message' => '登录成功', 'code' => 200, 'return' => []])
                    ->cookie($cookieUserName)
                    ->cookie($cookiePassWord)
                    ->cookie($cookieRemember);
            }

        } else {
            return response()->json(['message' => '密码错误', 'code' => 0, 'return' => []]);
        }


    }

    // 设置登录信息
    protected function setUpUserLoginData($username)
    {
        session(['UserLoginData' => [
            'username' => $username,
            'loginstate' => 1,
            'logintime' => time()
        ]]);
    }
}