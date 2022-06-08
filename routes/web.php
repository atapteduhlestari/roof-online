<?php

use App\Http\Controllers\AppraisalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SBUController;
use App\Http\Controllers\SDBController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\TrnSDBController;
use App\Http\Controllers\RenewalController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssetChildController;
use App\Http\Controllers\AssetGroupController;
use App\Http\Controllers\TrnRenewalController;
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
    Route::get('/asset-export/{param}', [AssetController::class, 'export'])->name('asset-export');
    Route::get('/api/getData', [AssetController::class, 'getData'])->name('getData.asset');

    Route::resource('/asset-child', AssetChildController::class)->except(['create']);
    Route::get('/asset-child/download/{assetChild}', [AssetChildController::class, 'download']);

    Route::resource('/appraisal', AppraisalController::class);

    Route::resource('/sdb', SDBController::class)->except(['create']);
    Route::resource('/sbu', SBUController::class)->except(['create']);

    Route::resource('/maintenance', MaintenanceController::class)->except(['create']);
    Route::resource('/renewal', RenewalController::class)->except(['create']);

    Route::resource('/trn-renewal', TrnRenewalController::class);
    Route::post('/trn-renewal/search', [TrnRenewalController::class, 'search']);
    Route::put('/trn-renewal/update-status/{trnRenewal}', [TrnRenewalController::class, 'updateStatus']);
    Route::put('/trn-renewal/download/{trnRenewal}', [TrnRenewalController::class, 'download']);
    Route::get('/trn-renewal-export', [TrnRenewalController::class, 'export'])->name('renewal-export');

    Route::resource('/trn-maintenance', TrnMaintenanceController::class);
    Route::post('/trn-maintenance/search', [TrnMaintenanceController::class, 'search']);
    Route::put('/trn-maintenance/update-status/{trnMaintenance}', [TrnMaintenanceController::class, 'updateStatus']);
    Route::get('/trn-maintenance/download/{trnMaintenance}', [TrnMaintenanceController::class, 'download']);
    Route::get('/trn-maintenance-export', [TrnMaintenanceController::class, 'export'])->name('maintenance-export');

    Route::resource('/trn-sdb', TrnSDBController::class)->parameters([
        'trn-sdb' => 'trnSDB',
    ]);

    Route::post('/trn-sdb/search', [TrnSDBController::class, 'search']);

    Route::get('/trn-sdb/asset/{id}', [TrnSDBController::class, 'formAsset']);
    Route::post('/trn-sdb/asset/store', [TrnSDBController::class, 'storeAsset']);
    Route::delete('/trn-sdb/asset/{id}', [TrnSDBController::class, 'deleteAsset']);

    Route::get('/trn-sdb/doc/{id}', [TrnSDBController::class, 'formDoc']);
    Route::post('/trn-sdb/doc/store', [TrnSDBController::class, 'storeDoc']);
    Route::delete('/trn-sdb/doc/{id}', [TrnSDBController::class, 'deleteDoc']);

    Route::resource('/cycle', CycleController::class)->except(['create']);
    Route::resource('/employee', EmployeeController::class)->except(['create']);

    Route::get('/full-calendar', [DashboardController::class, 'fullCalendar']);

    Route::get('/timeline', [DashboardController::class, 'timeline']);
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
