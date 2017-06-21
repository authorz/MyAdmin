<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class Site extends Model
{
    protected $table = 'site';

    public $primaryKey = 'Id';

    public $timestamps = false;

    public static function addSite(array $data) : bool
    {
        $diyField = new Site();

        unset($data['redirect']);

        foreach ($data as $key => $value) {

            $value = ($key == 'Name') ? strtoupper($value) : (isset($value) ? $value : '');

            $diyField->$key = $value;
        }

        $diyField->value = '';

        return $diyField->save();
    }

    public static function updateSite(array $data) : bool
    {
        $diyField = Site::find($data['Id']);

        unset($data['redirect'], $data['Id']);

        foreach ($data as $key => $value) {

            $value = ($key == 'Name') ? strtoupper($value) : (isset($value) ? $value : '');

            $diyField->$key = $value;
        }

        $diyField->value = '';

        return $diyField->save();

    }

    public static function deleteSite(array $id) : bool
    {
        return DB::table('site')->whereIn('Id', $id)->delete();
    }

    public static function getSiteForClass(int $id) : array
    {
        return DB::table('site')->where('BindClass', $id)->get()->toArray();
    }

    public static function getSiteList(int $id = 1) : LengthAwarePaginator
    {
        return self::where('BindClass', $id)->paginate(10);
    }

    public static function getSiteDetail(int $id)
    {
        return DB::table('site')->where('Id', $id)->first();
    }

    public static function getSiteWithValue(int $id) : array
    {
        $tree = [];

        $list = DB::table('site')->where('BindClass', $id)->get();

        foreach ($list as $key => $value) {
            $tree[$value->Name] = $value;
        }

        return $tree;
    }

    public static function updateSiteWithValue(array $data) : bool
    {

        $result = [];

        DB::beginTransaction();

        foreach ($data as $key => $value) {

            $value = isset($value) ? $value : '';

            $result[] = DB::table('site')->where('Name', $key)->update(['Value' => $value]);
        }


        DB::commit();

        return true;

    }

}
