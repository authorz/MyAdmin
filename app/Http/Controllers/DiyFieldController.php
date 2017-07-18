<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DiyField\Builders;
use App\Model\Site;
use App\Model\SiteClass;
use App\Model\SiteType;
use Illuminate\Http\Request;

class DiyFieldController extends Controller
{
    use Builders;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->input('id', 1);

        $siteClass = SiteClass::siteClassForDiy();

        $siteList = Site::getSiteList($id);

        $this->indexBuilder(['siteClass' => $siteClass, 'siteList' => $siteList->toArray()['data']], $siteList->links(), $id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->input('id', 1);

        $id = ($id == -1) ? 0 : $id;

        $siteTypeList = SiteType::getSityTypeForSelect();

        $siteClsssList = SiteClass::getSiteClassForSelect();

        $this->createBuilder(['siteTypeList' => $siteTypeList, 'siteClsssList' => $siteClsssList], $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = Site::addSite($request->all());

        if ($result) {
            return response()->json(['message' => '添加成功', 'code' => 200]);
        } else {
            return response()->json(['message' => '添加失败', 'code' => 0]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $siteDetail = Site::getSiteDetail($request->input('Id'));

        $siteTypeList = SiteType::getSityTypeForSelect();

        $siteClsssList = SiteClass::getSiteClassForSelect();

        return $this->editBuilder(['siteTypeList' => $siteTypeList, 'siteClsssList' => $siteClsssList, 'siteDetail' => $siteDetail], $request->input('BindClass'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $result = Site::updateSite($request->all());

        if ($result) {
            return response()->json(['message' => '编辑成功', 'code' => 200]);
        } else {
            return response()->json(['message' => '编辑失败', 'code' => 0]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = explode(',', $request->input('Id'));

        $result = Site::deleteSite($data);

        if ($result) {
            return response()->json(['message' => '删除成功', 'code' => 200]);
        } else {
            return response()->json(['message' => '删除失败', 'code' => 0]);
        }
    }
}
