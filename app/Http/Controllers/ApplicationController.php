<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplicationModel;
use \Firebase\JWT\JWT;

class ApplicationController extends Controller
{
    /**
     * 所有的应用列表
     */
    public function index(Request $request)
    {
        $applications['public']  = ApplicationModel::where('username', null)->get();
        $applications['private'] = ApplicationModel::whereNotNull('username')->get();

        return response()->json($applications);
    }
}