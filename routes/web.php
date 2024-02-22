<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\Admin\{AuthController, SectionController, UserController};
use App\Http\Controllers\PermohonanController;
use App\Models\User;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Livewire\Livewire;




// get

Route::get('/',[AuthController::class,'getLogin'])->name('getLogin');

Route::prefix('admin')->middleware('auth')->group(function (){
    
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/dashboard',[SectionController::class,'dashboard'])->name('dashboard')->middleware('auth');
    Route::get('/permohonan',[SectionController::class,'showpermohonan'])->name('showpermohonan');
    Route::get('/daftar_user', [SectionController::class, 'show'])->name('userview');
    Route::get('/daftar_user/data', [UserController::class, 'getData'])->name('userview.data');
    Route::get('/edit_user/{id}',[SectionController::class,'edit'])->name('useredit');


// post

    Route::match(['put', 'post'], '/update_user/{id}', [UserController::class, 'updateadmin'])->name('updateadmin');
    Route::match(['put', 'post'], '/update_permohonan/{id}', [UserController::class, 'updatespermohonan'])->name('postUpdatePermohonan');

// livewire
    // Route::livewire('/update_user/{id}', Updateadmin::class)->name('updateadmin');


});
Route::post('/login',[AuthController::class,'postLogin'])->name('postLogin');

Route::post('/login-android', [AuthController::class, 'loginandroid']);
Route::post('/login-android-google',[AuthController::class,'CAUG']);
Route::post('/register-android',[UserController::class,'RUS']);
Route::group(['middleware' => ['auth:api']], function () {
    
    // Other authenticated routes
});
Route::get('/table-permohonan', [UserController::class, 'DPA']);
