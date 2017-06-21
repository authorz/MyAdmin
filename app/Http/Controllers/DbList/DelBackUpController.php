<?php

namespace App\Http\Controllers\DbList;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DelBackUpController extends Controller
{
    public function __invoke(Request $request)
    {
        $filename = explode(',', $request->input('filename'));

        $result = Storage::delete($filename);

        if ($result) {
            return response()->json(['message' => '删除成功', 'code' => 200]);
        } else {
            return response()->json(['message' => '删除失败', 'code' => 0]);
        }
    }
}
