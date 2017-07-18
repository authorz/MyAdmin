<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SiteType extends Model
{
    protected $table = 'sitetype';

    public $primaryKey = 'Id';

    public $timestamps = false;

    public static function getSityTypeForSelect() : array
    {
        $tree = [];

        $list = DB::table('sitetype')->get();

        foreach ($list as $key => $value) {
            $tree[$value->Id] = $value->Name;
        }

        return $tree;
    }
}
