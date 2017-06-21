<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class MainType extends Model
{
    protected $table = 'maintype';

    public $primaryKey = 'Id';

    public $timestamps = false;

    public static function getMainTypeList() : array
    {
        $tree = [];

        $allType = self::all();

        foreach ($allType as $key => $value) {
            $tree[$value->Id] = $value->Name;
        }

        return $tree;
    }

    public static function getMainType() : LengthAwarePaginator
    {
        return self::paginate(10);
    }
}
