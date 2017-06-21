<?php

namespace App\Http\Controllers\DbList;

use App\Model\DbList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackupController extends Controller
{
    public function __invoke(Request $request)
    {
        $result = DbList::backup($request->input('tableName'));

        if ($result) {
            return response()->json(['message' => '生成成功', 'code' => 200]);
        } else {
            return response()->json(['message' => '生成失败', 'code' => 0]);
        }
    }
}
