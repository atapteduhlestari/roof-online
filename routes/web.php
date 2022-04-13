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


Route::middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::get('/home', function () {
        return redirect('/');
    })->name('home');

    Route::resource('/asset-group', AssetGroupController::class)
        ->except(['create']);

    Route::resource('/asset-parent', AssetController::class)
        ->parameters([
            'asset-parent' => 'asset',
        ])->except(['create']);

    Route::get('/asset-parent/docs/{asset}', [AssetController::class, 'documents'])
        ->name('assetDocuments');

    Route::post('/asset-parent/docs/add/{asset}', [AssetController::class, 'addDocuments'])
        ->name('assetAddDocuments');

    Route::get('/asset-parent/docs/edit/{asset}/{id}', [AssetController::class, 'editDocuments'])
        ->name('asseteditDocuments');

    Route::put('/asset-parent/docs/update/{asset}/{id}', [AssetController::class, 'updateDocuments'])
        ->name('assetupdateDocuments');

    Route::delete('/asset-parent/docs/delete/{asset}/{id}', [AssetController::class, 'deleteDocuments'])
        ->name('assetDeleteDocuments');

    Route::resource('/maintenance', MaintenanceController::class)->except(['create']);
    Route::resource('/renewal', RenewalController::class)->except(['create']);
    Route::resource('/storage', StorageController::class)->except(['create']);

    Route::resource('/trn-renewal', TrnRenewalController::class)->except(['create']);
    Route::post('/trn-renewal/search', [TrnRenewalController::class, 'search']);

    Route::resource('/trn-maintenance', TrnMaintenanceController::class)->except(['create']);

    Route::resource('/trn-storage', TrnStorageController::class)->except(['create']);

    Route::resource('/cycle', CycleController::class)->except(['create']);
    Route::resource('/employee', EmployeeController::class)->except(['create']);
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
