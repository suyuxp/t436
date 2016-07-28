<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplicationModel;
use Validator;

class PrivateApplicationController extends Controller
{
    /**
     * 所有的私有应用列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $applications = ApplicationModel::where('username', $request->username)
                                        ->orderBy('priority', 'desc')
                                        ->get();

        return response()->json($applications);
    }

    /**
     * 增加私有应用
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

        $inputs['username'] = $request->username;
        $applications = ApplicationModel::create($inputs);

        return response()->json($applications, 201);
    }

    /**
     * 指定的私有应用
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $application = ApplicationModel::where('id', $id)->where('username', $request->username)->first();

        if (empty($application)) {
            return response()->json('not found', 404);
        }

        return response()->json($application);
    }

    /**
     * 修改私有应用
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $application = ApplicationModel::where('id', $id)->where('username', $request->username)->first();

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

        $inputs['username'] = $request->username;
        $application->update($inputs);

        return response()->json($application, 200);
    }

    /**
     * 删除私有应用
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $application = ApplicationModel::where('id', $id)->where('username', $request->username)->first();

        if (empty($application)) {
            return response()->json('not found', 404);
        }

        $application->delete();

        return response()->json(null, 204);
    }
}
