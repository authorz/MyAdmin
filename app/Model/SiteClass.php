<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class SiteClass extends Model
{
    protected $table = 'siteclass';

    public $primaryKey = 'Id';

    public $timestamps = false;

    public static function getSiteClassList() : array
    {
        return DB::table('siteclass')->orderBy('Sort', 'ASC')->get()->toArray();
    }


    public static function siteClassForWebSite()
    {
        $tree = [];

        $siteClass = DB::table('siteclass')
            ->where('Show', 0)
            ->orderBy('Sort', 'ASC')->get();

        foreach ($siteClass as $key => $value) {
            $tree[] = [
                'name' => $value->Name,
                'url' => '?id=' . $value->Id,
                'value' => $value->Id
            ];
        }

        return $tree;
    }

    public static function siteClassForDiy()
    {
        $tree = [];

        $siteClass = DB::table('siteclass')
            ->where('Show', 0)
            ->orderBy('Sort', 'ASC')->get();

        foreach ($siteClass as $key => $value) {
            $tree[] = [
                'name' => $value->Name,
                'url' => '?id=' . $value->Id,
                'value' => $value->Id
            ];
        }

        array_push($tree, ['name' => '无分类', 'url' => '?id=-1', 'value' => -1]);

        return $tree;
    }


    public static function getSiteClassForSelect() : array
    {
        $tree = [];

        $siteClass = DB::table('siteclass')
            ->where('Show', 0)
            ->orderBy('Sort', 'ASC')->get();

        foreach ($siteClass as $key => $value) {
            $tree[$value->Id] = $value->Name;
        }

        array_unshift($tree, '不选择分类');

        return $tree;
    }
}
