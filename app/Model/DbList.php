<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Spatie\DbDumper\Databases\MySql;


class DbList extends Model
{
    public static function getDbList() : array
    {


        $param = 'Tables_in_' . env('DB_DATABASE');

        $tree = [];

        $tableList = DB::select('SHOW TABLES');

        foreach ($tableList as $key => $value) {

            $tree[] = [

                'tableName' => $value->$param,

                'tableCount' => DB::select("SELECT COUNT(*) AS `number` FROM " . $value->$param)[0]->number,

                'tableSize' => DB::connection('mysql_admin')->select(self::getSiteWithTable($value->$param))[0]->data
            ];

        }

        return $tree;
    }

    protected static function getSiteWithTable(string $tableName) : string
    {
        $dbName = env('DB_DATABASE');

        return "select concat(round(sum(DATA_LENGTH/1024/1024),2),'MB') as data from tables where table_schema='{$dbName}' AND table_name = '{$tableName}'";
    }

    public static function backup(string $tables) : bool
    {
        try {
            MySql::create()
                ->setDbName(env('DB_DATABASE'))
                ->setUserName(env('DB_USERNAME'))
                ->setPassword(env('DB_PASSWORD'))
                ->includeTables(explode(',', $tables))
                ->dumpToFile('storage/backup/' . date('YmdHis', time()) . '.sql');

            return true;
        } catch (Exception $e) {
            return false;
        }

    }

    public static function querySql(string $sql)
    {
        try {
            return DB::select($sql);
        } catch (QueryException $e) {
            return $e->getMessage();
        }

    }

    public static function repair(array $tableName)
    {
        foreach ($tableName as $value) {
            DB::statement('REPAIR TABLE `' . $value . '`');
        }
    }

    public static function optimize(array $tableName)
    {
        foreach ($tableName as $value) {
            DB::statement('OPTIMIZE TABLE `' . $value . '`');
        }
    }

}
