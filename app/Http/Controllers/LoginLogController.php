<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoginLog\Builders;
use App\Model\LoginLog;
use Illuminate\Http\Request;

class LoginLogController extends Controller
{
    use Builders;

    public function index()
    {
        $list = LoginLog::getLogList();

        $this->indexBuilder(json_decode($list->toJson(), true)['data'], $list->links());
    }
}
