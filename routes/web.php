<?php

use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MovedAssetController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\DataMaster\User\UserController;
use App\Http\Controllers\DataAssets\FixedAssetController;
use App\Http\Controllers\DataMaster\Category\CategoryController;
use App\Http\Controllers\DataMaster\Division\DivisionController;
use App\Http\Controllers\DataMaster\Location\LocationController;
use App\Http\Controllers\DataMaster\Location\SpecialLocationController;
use App\Http\Controllers\DataMaster\Procurement\ProcurementController;
use App\Http\Controllers\DataMaster\SubCategory\SubCategoryController;
use App\Http\Controllers\DataMaster\UnitController;
use App\Http\Controllers\Monitoring\DashboardController;
use App\Http\Controllers\Monitoring\MonitoringController;
use App\Models\DataAsset\FixedAsset;
use App\Models\DataMaster\SpecialLocation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Data Masetr
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard-user', [DashboardController::class, 'getUsers'])->name('home.users');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('user/detail/{id}', [UserController::class, 'detail'])->name('user.detail');
    Route::put('user/detail/{id}', [UserController::class, 'updateProfile'])->name('user.update-porfile');
});

Route::middleware(['auth', 'super_admin'])->group(function () {
    Route::prefix('data-master')->group(function () {

        // Category
        Route::prefix('/category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index');
            Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
        });

        // Sub Categoru
        Route::prefix('/sub-category')->group(function () {
            Route::get('/', [SubCategoryController::class, 'index'])->name('sub-category.index');
            Route::post('/store', [SubCategoryController::class, 'store'])->name('sub-category.store');
            Route::put('/update/{id}', [SubCategoryController::class, 'update'])->name('sub-category.update');
            Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('sub-category.edit');
            Route::delete('/delete/{id}', [SubCategoryController::class, 'destroy'])->name('sub-category.destroy');
        });

        // Location
        Route::prefix('location')->group(function () {
            Route::get('/', [LocationController::class, 'index'])->name('location.index');
            Route::post('/store', [LocationController::class, 'store'])->name('location.store');
            Route::post('/edit', [LocationController::class, 'edit'])->name('location.edit');
            Route::delete('/delete', [LocationController::class, 'destroy'])->name('location.destroy');
        });

        // Specific Location
        Route::prefix('/specific-location')->group(function () {
            Route::get('/', [SpecialLocationController::class, 'index'])->name('special-location.index');
            Route::post('/store', [SpecialLocationController::class, 'store'])->name('special-location.store');
            Route::post('/edit', [SpecialLocationController::class, 'edit'])->name('special-location.edit');
            Route::delete('/delete', [SpecialLocationController::class, 'destroy'])->name('special-location.destroy');
        });

        // Division
        Route::prefix('division')->group(function () {
            Route::get('/', [DivisionController::class, 'index'])->name('division.index');
            Route::post('/store', [DivisionController::class, 'store'])->name('division.store');
            Route::post('/edit', [DivisionController::class, 'edit'])->name('division.edit');
            Route::delete('/delete', [DivisionController::class, 'destroy'])->name('division.destroy');
        });

        // Unit
        Route::prefix('unit')->group(function () {
            Route::get('/', [UnitController::class, 'index'])->name('unit.index');
            Route::post('/store', [UnitController::class, 'store'])->name('unit.store');
            Route::post('/edit', [UnitController::class, 'edit'])->name('unit.edit');
            Route::delete('/delete', [UnitController::class, 'destroy'])->name('unit.destroy');
        });

        Route::prefix('procurement')->group(function () {
            Route::get('/', [ProcurementController::class, 'index'])->name('procurement.index');
            Route::post('/store', [ProcurementController::class, 'store'])->name('procurement.store');
            Route::post('/edit', [ProcurementController::class, 'edit'])->name('procurement.edit');
            Route::delete('/delete', [ProcurementController::class, 'destroy'])->name('procurement.destroy');
        });

        // User
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::post('/store', [UserController::class, 'store'])->name('user.store');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        });
    });
});

// Data Aset
Route::middleware(['auth'])->group(function () {
    // Data aset
    Route::prefix('data-assets')->group(function () {
        // Fixed Asset
        Route::controller(FixedAssetController::class)->prefix('fixed')->group(function () {
            Route::get('/', 'index')->name('asset-fixed.index');
            Route::get('/create', 'create')->name('asset-fixed.create');
            // Route::post('/store', 'store')->name('asset-fixed.store');
            Route::post('/storeAjax', 'storeAjax')->name('asset-fixed.store.ajax');
            Route::get('/edit/{id}', 'edit')->name('asset-fixed.edit');
            Route::put('/update/{id}', 'update')->name('asset-fixed.update');
            Route::get('/show/{id}', 'show')->name('asset-fixed.show');
            Route::delete('/delete/{id}', 'destroy')->name('asset-fixed.destroy');
            Route::post('/delete-selected-asset', 'DeleteSelectedAsset')->name('asset-fixed.destroy.selected');
            Route::get('/download/qrcode/{id}', 'DownloadQrCode')->name('asset-fixed.downloadQrCode');
            Route::post('/download-selected-qrcodes', 'downloadSelectedQrCodes')->name('download-selected-qrcodes');
            Route::get('/download-selected-qrcodes-zip', 'downloadSelectedQrCodesZip')->name('download-selected-qrcodes-zip');
            Route::post('/save-filters-to-session', 'saveFiltersToSession')->name('save-filters-to-session');
            Route::post('/import-excel', 'import')->name('import-excel');
            Route::get('/export', 'exportTemplate')->name('export-template');
            Route::post('/update-sn', 'updateSn')->name('asset-fixed.update.sn');
            Route::post('/update-bmn', 'updateBmn')->name('asset-fixed.update.bmn');
            Route::get('/download/qrcode/location/{id}', 'DownloadQrCodeLocation')->name('asset-fixed.downloadQrCode-location');
        });

        // Moved Asset
        Route::get('/asset-moved', [MovedAssetController::class, 'index'])->name('asset-moved.index');
        Route::get('/asset-moved/create', [MovedAssetController::class, 'create'])->name('asset-moved.create');
        Route::get('/asset-moved/edit', [MovedAssetController::class, 'edit'])->name('asset-moved.edit');
        Route::get('/asset-moved/show', [MovedAssetController::class, 'show'])->name('asset-moved.show');
    });

    // Monitoring
    Route::prefix('monitoring')->group(function () {
        Route::get('/', [MonitoringController::class, 'index'])->name('monitoring.index');
        Route::get('/create', [MonitoringController::class, 'create'])->name('monitoring.create');
        Route::get('/edit/{id}', [MonitoringController::class, 'edit'])->name('monitoring.edit');
        Route::get('/show/{id}', [MonitoringController::class, 'show'])->name('monitoring.show');
    });

    // Report
    Route::group(['prefix' => 'report'], function () {
        Route::get('/', [ReportController::class, 'index'])->name('report.index');
        Route::get('/create', [ReportController::class, 'create'])->name('report.create');
        Route::get('/export', [ReportController::class, 'export'])->name('report.export');
        Route::get('/show/{id}', [ReportController::class, 'show'])->name('report.show');
    });
});

// Public Access
Route::get('show-public/{id}', [ReportController::class, 'showPublic'])->name('report.show-public');
Route::get('list-public', [ReportController::class, 'listPublic'])->name('report.list-public');


// Auth
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login.index');
    Route::post('/login', [AuthController::class, 'login'])->name('signin');
    Route::get('/login-sso', [AuthController::class, 'ssoLogin'])->name('signin-sso');
});