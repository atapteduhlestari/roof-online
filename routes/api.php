<?php

use App\Models\Cycle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tes-api', function () {
    $data = Cycle::get();
    $api = json_encode($data);
    echo $api;
    // return response()->json(
    //     [
    //         'data' => $data,
    //         'message' => 'success',
    //         'status' => 200
    //     ]
    // );
});
