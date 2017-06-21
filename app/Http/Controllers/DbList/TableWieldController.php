<?php

namespace App\Http\Controllers\DbList;

use App\Model\DbList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TableWieldController extends Controller
{
    // 修复表
    public function repair(Request $request)
    {
        $tableList = explode(',', $request->input('tableName'));

        DbList::repair($tableList);

        return response()->json(['message' => '修复成功', 'code' => 200]);

    }

    // 优化表
    public function optimize(Request $request)
    {
        $tableList = explode(',', $request->input('tableName'));

        DbList::optimize($tableList);

        return response()->json(['message' => '优化成功', 'code' => 200]);
    }
}
