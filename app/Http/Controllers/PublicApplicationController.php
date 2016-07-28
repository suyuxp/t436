<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplicationModel;
use Validator;

class PublicApplicationController extends Controller
{
    /**
     * 所有的公共应用列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = ApplicationModel::whereNull('username')->get();
        return response()->json($applications);
    }

    /**
     * 增加公共应用
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $inputs['priority'] = $request->input('priority', 0);

        $validator = Validator::make($inputs, [
            'name'      => 'required',
            'url'       => 'required',
            'priority'  => 'integer|min:0'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json($errors);
        }

        $inputs['username'] = null;
        $applications = ApplicationModel::create($inputs);

        return response()->json($applications, 201);
    }

    /**
     * 指定的公共应用
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $application = ApplicationModel::where('id', $id)->whereNull('username')->first();
        if (empty($application)) {
            return response()->json('not found', 404);
        }

        return response()->json($application);
    }

    /**
     * 修改公共应用
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $application = ApplicationModel::where('id', $id)->whereNull('username')->first();
        if (empty($application)) {
            return response()->json('not found', 404);
        }

        $inputs = $request->all();
        $inputs['priority'] = $request->input('priority', 0);
        $validator = Validator::make($inputs, [
            'name'      => '',
            'url'       => '',
            'priority'  => 'integer|min:0'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json($errors);
        }

        $inputs['username'] = null;
        $application->update($inputs);

        return response()->json($application, 200);
    }

    /**
     * 删除公共应用
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $application = ApplicationModel::where('id', $id)->whereNull('username')->first();
        if (empty($application)) {
            return response()->json('not found', 404);
        }

        $application->delete();

        return response()->json(null, 204);
    }
}
