<?php

use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
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
use App\Http\Controllers\Monitoring\DashboardController;
use App\Http\Controllers\Monitoring\MonitoringController;
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

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::prefix('data-master')->group(function () {

    // Category
    Route::prefix('/category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::post('/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::delete('/delete', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    // Sub Categoru
    Route::prefix('/sub-category')->group(function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('sub-category.index');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('sub-category.store');
        Route::post('/edit', [SubCategoryController::class, 'edit'])->name('sub-category.edit');
        Route::delete('/delete', [SubCategoryController::class, 'destroy'])->name('sub-category.destroy');
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


    // Location
    Route::prefix('division')->group(function () {
        Route::get('/', [DivisionController::class, 'index'])->name('division.index');
        Route::post('/store', [DivisionController::class, 'store'])->name('division.store');
        Route::post('/edit', [DivisionController::class, 'edit'])->name('division.edit');
        Route::delete('/delete', [DivisionController::class, 'destroy'])->name('division.destroy');
    });

    Route::prefix('procurement')->group(function () {
        Route::get('/', [ProcurementController::class, 'index'])->name('procurement.index');
        Route::post('/store', [ProcurementController::class, 'store'])->name('procurement.store');
        Route::post('/edit', [ProcurementController::class, 'edit'])->name('procurement.edit');
        Route::delete('/delete', [ProcurementController::class, 'destroy'])->name('procurement.destroy');
    });

    // User
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/user-detail', [UserController::class, 'detail'])->name('user.detail');
});

// Data aset
Route::prefix('data-assets')->group(function () {
    // Fixed Asset
    Route::prefix('fixed')->group(function () {
        Route::get('/', [FixedAssetController::class, 'index'])->name('asset-fixed.index');
        Route::get('/create', [FixedAssetController::class, 'create'])->name('asset-fixed.create');
        Route::post('/store', [FixedAssetController::class, 'store'])->name('asset-fixed.store');
        Route::get('/edit', [FixedAssetController::class, 'edit'])->name('asset-fixed.edit');
        Route::get('/show/{id}', [FixedAssetController::class, 'show'])->name('asset-fixed.show');
        Route::delete('/delete/{id}', [FixedAssetController::class, 'destroy'])->name('asset-fixed.destroy');
    });
});

// Moved Asset
Route::get('/asset-moved', [MovedAssetController::class, 'index'])->name('asset-moved.index');
Route::get('/asset-moved/create', [MovedAssetController::class, 'create'])->name('asset-moved.create');
Route::get('/asset-moved/edit', [MovedAssetController::class, 'edit'])->name('asset-moved.edit');
Route::get('/asset-moved/show', [MovedAssetController::class, 'show'])->name('asset-moved.show');


// Monitoring
Route::prefix('monitoring')->group(function () {
    Route::get('/', [MonitoringController::class, 'index'])->name('monitoring.index');
    Route::get('/create', [MonitoringController::class, 'create'])->name('monitoring.create');
    Route::get('/edit', [MonitoringController::class, 'edit'])->name('monitoring.edit');
    Route::get('/show/{id}', [MonitoringController::class, 'show'])->name('monitoring.show');
});


// Report
Route::get('/report', [ReportController::class, 'index'])->name('report.index');
Route::get('/report/create', [ReportController::class, 'create'])->name('report.create');

// Auth
Route::get('/login', [AuthController::class, 'index'])->name('login');
