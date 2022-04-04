<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\RenewalController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssetGroupController;
use App\Http\Controllers\TrnRenewalController;
use App\Http\Controllers\TrnStorageController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\TrnMaintenanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    Route::get('/', function () {
        return view('index');
    })->name('home');

    Route::resource('/asset-group', AssetGroupController::class);
    Route::resource('/asset-parent', AssetController::class)->parameters([
        'asset-parent' => 'asset',
    ]);
    Route::get('/asset-parent/docs/{asset}', [AssetController::class, 'documents'])->name('assetDocuments');
    Route::post('/asset-parent/docs/add/{asset}', [AssetController::class, 'addDocuments'])->name('assetAddDocuments');
    Route::get('/asset-parent/docs/edit/{asset}/{id}', [AssetController::class, 'editDocuments'])->name('asseteditDocuments');
    Route::put('/asset-parent/docs/update/{asset}/{id}', [AssetController::class, 'updateDocuments'])->name('assetupdateDocuments');
    Route::delete('/asset-parent/docs/delete/{asset}/{id}', [AssetController::class, 'deleteDocuments'])->name('assetDeleteDocuments');

    Route::resource('/maintenance', MaintenanceController::class);
    Route::resource('/renewal', RenewalController::class);
    Route::resource('/storage', StorageController::class);

    Route::resource('/trn-renewal', TrnRenewalController::class);

    Route::resource('/trn-maintenance', TrnMaintenanceController::class);

    Route::resource('/trn-storage', TrnStorageController::class);

    Route::resource('/cycle', CycleController::class);

    Route::resource('/employee', EmployeeController::class);
});

// Route::get('/get-api', function () {
//     $response = Http::get('http://192.168.1.11:8101/api/tes-api');
//     $json = $response->json();

//     $data = collect($json)->where('id', 1)->first();
//     return $data;
// });

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);
