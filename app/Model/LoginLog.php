<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class LoginLog extends Model
{
    protected $table = 'loginlog';

    public $primaryKey = 'Id';

    public $timestamps = false;

    public function recordLog(string $username, string $ip) : bool
    {
        $result = DB::table('loginlog')->insert([
            'UserId' => User::userNameWithId($username),
            'Ip' => $ip,
            'LoginTime' => date('Y-m-d H:i:s', time())
        ]);

        return $result;
    }

    public static function getLogList() : LengthAwarePaginator
    {
        return DB::table('loginlog')
            ->join('user', 'loginlog.UserId', '=', 'user.ID')
            ->select('loginlog.*', 'user.Name')
            ->orderBy('loginlog.LoginTime', 'desc')
            ->paginate(10);
    }
}
