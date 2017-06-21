<?php

namespace App\Http\Controllers;

use App\Http\Controllers\WebSite\Builders;
use App\Model\Site;
use App\Model\SiteClass;
use Illuminate\Http\Request;

class WebSiteController extends Controller
{

    use Builders;

    public function index(Request $request)
    {
        $id = $request->input('id', 1);

        $siteList = Site::getSiteWithValue($id);

        return $this->indexBuilder(['siteClass' => SiteClass::siteClassForWebSite(), 'siteList' => $siteList], Site::getSiteForClass($id));
    }

    public function store(Request $request)
    {
        $result = Site::updateSiteWithValue($request->all());

        if ($result) {
            return response()->json(['message' => '更新成功', 'code' => 200]);
        } else {
            return response()->json(['message' => '更新失败', 'code' => 0]);
        }
    }
}
