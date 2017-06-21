<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DbList\Builders;
use App\Model\DbList;
use Illuminate\Http\Request;
use App\Builder;
use Illuminate\Support\Facades\Storage;

class DbListController extends Controller
{
    use Builders;

    public function index(Request $request)
    {
        switch ($request->input('id')) {
            case 1:
                $this->dblist();
                break;
            case 2:
                $this->backupList();
                break;
            case 3:
                $this->querySql($request);
                break;
            default:
                $this->dblist();
                break;
        }
    }

    // 数据表列表
    public function dbList()
    {
        $listData = DbList::getDbList();

        return $this->indexBuilder($listData);
    }

    //  备份列表
    public function backupList()
    {
        $fileList = Storage::files('/public/backup/');

        foreach ($fileList as $key => $value) {

            $name = function () use ($value) {

                $arrayNum = explode('/', $value);

                return $arrayNum[count($arrayNum) - 1];
            };

            $tree[$key]['name'] = $name();
            $tree[$key]['filename'] = $value;
            $tree[$key]['filesize'] = round((Storage::size($value)) / 1024) . 'KB';
        }

        $tree = ($tree == null) ? [] : $tree;

        return $this->backupBuilder($tree);
    }

    // 执行sql
    public function querySql($request)
    {


        if ($request->isMethod('post')) {

            $sqlContent = $request->input('sqlContent');

            if ($sqlContent == NULL) {
                return $this->queryBuilder([]);
            }

            $querySql = json_encode(DbList::querySql($request->input('sqlContent')));

            return $this->queryBuilder(['sql' => $sqlContent, 'result' => $querySql]);
        }

        return $this->queryBuilder([]);
    }
}
