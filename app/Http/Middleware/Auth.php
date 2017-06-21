<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\DB;


class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $NoAuth = [
            'admin/index',
            'admin/modifyEmail',
            'admin/getEmail',
            'admin/modifyPass'
        ];

        if (!$request->session()->has('UserLoginData.loginstate')) {
            return redirect('/');
        }

        if (!$request->session()->has('UserLoginData.username')) {
            return redirect('/');
        }


        $path = $request->path();

        $authState = DB::table('user')
            ->join('userroles', 'user.ID', '=', 'userroles.UserId')
            ->join('roles', 'userroles.RoleId', '=', 'roles.ID')
            ->join('rolepermissions', 'roles.ID', '=', 'rolepermissions.RoleId')
            ->join('node', 'rolepermissions.PermissionID', '=', 'node.Id')
            ->where('Name', $request->session()->get('UserLoginData.username'))
            ->where('node.Href', $path)
            ->count();


        if ($authState === 0 && !in_array($path, $NoAuth)) {
            if ($request->ajax()) {
                return response()->json(['message' => '没有操作权限,请联系管理员', 'code' => 0]);
            } else {
                return redirect('/auth/error');
            }
        }


        return $next($request);
    }
}
