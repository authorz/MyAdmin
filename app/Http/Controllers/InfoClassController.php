<?php

namespace App\Http\Controllers;

use App\Http\Controllers\InfoClass\Builders;
use App\Model\InfoClass;
use Illuminate\Http\Request;

class InfoClassController extends Controller
{
    use Builders;

    protected $infoModel;

    public function __construct(InfoClass $infoClass)
    {
        $this->infoModel = $infoClass;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $infoclass = InfoClass::getInfoClass();

        return $this->indexBuilder($infoclass->toArray()['data'], $infoclass->links());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->createBuilder([]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = InfoClass::addInfoClass($request->all());

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
        $detail = InfoClass::getInfoClassDetail($request->input('Id'));

        return $this->editBuilder($detail);
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
        $result = InfoClass::updateInfoClass($request->all());

        if ($result) {
            return response()->json(['message' => '更新成功', 'code' => 200]);
        } else {
            return response()->json(['message' => '更新失败', 'code' => 0]);
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
        $result = InfoClass::destroyInfoClass($request->input('Id'));

        if ($result) {
            return response()->json(['message' => '删除成功', 'code' => 200]);
        } else {
            return response()->json(['message' => '删除失败', 'code' => 0]);
        }
    }
}
