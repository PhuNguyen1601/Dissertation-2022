<?php

use App\Http\Controllers\NewLichThiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BomonController;
use App\Http\Controllers\HocphanController;
use App\Http\Controllers\PhongController;
use App\Http\Controllers\HockiController;
use App\Http\Controllers\NienkhoaController;
use App\Http\Controllers\KehoachController;
use App\Http\Controllers\LophocphanController;
use App\Http\Controllers\GiangvienController;
use App\Http\Controllers\SVLHPController;
use App\Http\Controllers\TiethocController;
use App\Http\Controllers\LichthiController;
use App\Http\Controllers\DangkithiController;
use App\Http\Controllers\VideoController;






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

Route::get('/', [UserController::class, 'login'])->name('login');
Route::post('/', [UserController::class, 'checklogin'])->name('checklogin');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'CheckLoginMiddware'], function () {

    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::prefix('dangkithi')->group(function () {
            Route::get('/', [DangkithiController::class, 'index'])->name('dangkithi.index');
            Route::post('/save', [DangkithiController::class, 'save'])->name('dangkithi.save');
            Route::post('/dangki', [DangkithiController::class, 'dangki'])->name('dangkithi.dangki');
            Route::get('/listsvlhp/{iddk}', [DangkithiController::class, 'svlhp'])->name('dangkithi.svlhp');
            Route::post('/update', [DangkithiController::class, 'update'])->name('dangkithi.update');
        });
        Route::prefix('video')->group(function () {
            Route::get('/', [VideoController::class, 'index'])->name('video.index');
            Route::get('/lichthi', [VideoController::class, 'lichthi'])->name('video.lichthi');
            Route::get('/delete', [VideoController::class, 'delete'])->name('video.delete');
            Route::post('/upload-vd', [VideoController::class, 'upload'])->name('video.upload');
            Route::post('/download', [VideoController::class, 'download'])->name('video.download');
            Route::post('/detec', [VideoController::class, 'detec'])->name('video.detec');
            Route::get('/detection/{id}', [VideoController::class, 'decvideo'])->name('video.showvideo');
        });
        Route::group(['middleware' => 'CheckRole'], function () {
            Route::prefix('bomon')->group(function () {
                Route::get('/', [BomonController::class, 'index'])->name('bomon.index');
                Route::post('/save', [BomonController::class, 'save'])->name('bomon.save');
                Route::post('/delete', [BomonController::class, 'delete'])->name('bomon.delete');
                Route::post('/update', [BomonController::class, 'update'])->name('bomon.update');
                Route::post('/upload-bm', [BomonController::class, 'uploadBM'])->name('bomon.upload');
            });
            Route::prefix('hocphan')->group(function () {
                Route::get('/', [HocphanController::class, 'index'])->name('hocphan.index');
                Route::post('/save', [HocphanController::class, 'save'])->name('hocphan.save');
                Route::post('/delete', [HocphanController::class, 'delete'])->name('hocphan.delete');
                Route::post('/update', [HocphanController::class, 'update'])->name('hocphan.update');
                Route::post('/upload-hp', [HocphanController::class, 'uploadHP'])->name('hocphan.upload');
            });

            Route::prefix('phong')->group(function () {
                Route::get('/', [PhongController::class, 'index'])->name('phong.index');
                Route::post('/save', [PhongController::class, 'save'])->name('phong.save');
                Route::post('/delete', [PhongController::class, 'delete'])->name('phong.delete');
                Route::post('/update', [PhongController::class, 'update'])->name('phong.update');
                Route::post('/upload-p', [PhongController::class, 'uploadP'])->name('phong.upload');
            });
            Route::prefix('tiethoc')->group(function () {
                Route::get('/', [TiethocController::class, 'index'])->name('tiethoc.index');
                Route::post('/save', [TiethocController::class, 'save'])->name('tiethoc.save');
                Route::get('/delete/{math}', [TiethocController::class, 'delete'])->name('tiethoc.delete');
                Route::post('/update', [TiethocController::class, 'update'])->name('tiethoc.update');
                Route::post('/upload-th', [TiethocController::class, 'uploadTH'])->name('tiethoc.upload');
            });
            Route::prefix('hocki')->group(function () {
                Route::get('/', [HockiController::class, 'index'])->name('hocki.index');
                Route::post('/save', [HockiController::class, 'save'])->name('hocki.save');
                Route::get('/delete/{idhk}', [HockiController::class, 'delete'])->name('hocki.delete');
                Route::post('/update', [HockiController::class, 'update'])->name('hocki.update');
            });
            Route::prefix('nienkhoa')->group(function () {
                Route::get('/', [NienkhoaController::class, 'index'])->name('nienkhoa.index');
                Route::post('/save', [NienkhoaController::class, 'save'])->name('nienkhoa.save');
                Route::get('/delete/{idnk}', [NienkhoaController::class, 'delete'])->name('nienkhoa.delete');
                Route::post('/update', [NienkhoaController::class, 'update'])->name('nienkhoa.update');
                Route::post('/upload-nk', [NienkhoaController::class, 'uploadNK'])->name('nienkhoa.upload');
            });
            Route::prefix('kehoach')->group(function () {
                Route::get('/', [KehoachController::class, 'index'])->name('kehoach.index');
                Route::get('/lichthi/{idkh}', [LichthiController::class, 'index'])->name('lichthi.index');
                Route::post('/save', [KehoachController::class, 'save'])->name('kehoach.save');
                Route::get('/hide/{idkh}', [KehoachController::class, 'hide'])->name('kehoach.hide');
                Route::get('/display/{idkh}', [KehoachController::class, 'display'])->name('kehoach.display');
                Route::post('/update', [KehoachController::class, 'update'])->name('kehoach.update');
                Route::get('/import-kh', [KehoachController::class, 'importKH'])->name('kehoach.import');
                Route::post('/upload-kh', [KehoachController::class, 'uploadKH'])->name('kehoach.upload');
            });
            Route::prefix('lophocphan')->group(function () {
                Route::get('/', [LophocphanController::class, 'index'])->name('lophocphan.index');
                Route::post('/save', [LophocphanController::class, 'save'])->name('lophocphan.save');
                Route::get('/delete/{idlhp}', [LophocphanController::class, 'delete'])->name('lophocphan.delete');
                Route::post('/update', [LophocphanController::class, 'update'])->name('lophocphan.update');
                Route::post('/upload-lhp', [LophocphanController::class, 'uploadLHP'])->name('lophocphan.upload');
                Route::get('/delete/{idlhp}', [SVLHPController::class, 'delete'])->name('lophocphan.delete_svlhp');
                Route::post('/upload-sinhvien', [SVLHPController::class, 'uploadSVLHP'])->name('lophocphan.upload_csvsv');
                Route::get('/listsv/{lhpid}', [SVLHPController::class, 'index'])->name('lophocphan.listsv');
            });
            Route::prefix('giangvien')->group(function () {
                Route::get('/', [GiangvienController::class, 'index'])->name('giangvien.index');
                Route::post('/save', [GiangvienController::class, 'save'])->name('giangvien.save');
                Route::post('/update', [GiangvienController::class, 'update'])->name('giangvien.update');
                Route::post('/delete', [GiangvienController::class, 'delete'])->name('giangvien.delete');
                Route::post('/upload-gv', [GiangvienController::class, 'uploadGV'])->name('giangvien.upload');
            });
            Route::prefix('lichthi')->group(function () {
                Route::get('/', [NewLichThiController::class, 'xemLich'])->name('laplich.index');
                Route::post('/dangky', [LichthiController::class, 'dangky'])->name('laplich.dangky');
                Route::get('/xeplich', [NewLichThiController::class, 'xeplich'])->name('lichthi.xeplich');
                Route::get('/showlichthi/{id}', [NewLichThiController::class, 'showlichthi'])->name('lichthi.show');
                Route::get('/export-lichthi', [NewLichThiController::class, 'export'])->name('lichthi.export');
                Route::post('/laplich', [LichthiController::class, 'laplich'])->name('laplich.save');
                Route::get('/lichdaxep', [LichthiController::class, 'ToMau'])->name('laplich.tomau');
            });
        });
    });
});