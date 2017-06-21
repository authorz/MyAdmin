<?php

namespace App\Model;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class InfoClass extends Model
{
    protected $table = 'infoclass';

    public $primaryKey = 'Id';

    public $timestamps = false;

    public static function getInfoClass() : LengthAwarePaginator
    {
        return self::paginate(10);
    }

    public static function getInfoPageClass() : LengthAwarePaginator
    {
        return self::where('Type', 1)->paginate(10);
    }

    public static function addInfoClass(array $data) : bool
    {
        unset($data['redirect']);

        $infoClass = new InfoClass();

        foreach ($data as $key => $value) {
            $infoClass->$key = $value;
        }

        return $infoClass->save();

    }

    public static function updateInfoClass(array $data) : bool
    {
        unset($data['redirect']);

        $infoClass = self::find($data['Id']);

        unset($data['Id']);

        foreach ($data as $key => $value) {
            $infoClass->$key = $value;
        }

        return $infoClass->save();
    }

    public static function getInfoClassDetail(int $id) : array
    {
        return self::where('Id', $id)->first()->toArray();
    }

    public static function destroyInfoClass(string $id) : bool
    {
        return self::whereIn('Id', explode(',', $id))->delete();
    }

    public static function enableInfoClass(string $id) : bool
    {
        return self::whereIn('Id', explode(',', $id))->update(['hide' => 0]);
    }

    public static function disableInfoClass(string $id) : bool
    {
        return self::whereIn('Id', explode(',', $id))->update(['hide' => 1]);
    }
}
