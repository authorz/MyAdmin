<?php

namespace App\Http\Controllers\InfoClass;

use App\Model\InfoClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
    public function enable(Request $request)
    {
        $result = InfoClass::enableInfoClass($request->input('Id'));

        if ($result) {
            return response()->json(['message' => '启用成功', 'code' => 200]);
        } else {
            return response()->json(['message' => '启用失败', 'code' => 0]);
        }
    }

    public function disable(Request $request)
    {
        $result = InfoClass::disableInfoClass($request->input('Id'));

        if ($result) {
            return response()->json(['message' => '禁用成功', 'code' => 200]);
        } else {
            return response()->json(['message' => '禁用失败', 'code' => 0]);
        }
    }
}
