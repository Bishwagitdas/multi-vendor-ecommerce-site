<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BackEnd\AdminController;
use App\Http\Controllers\BackEnd\BrandController;
use App\Http\Controllers\BackEnd\VendorController;

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

Route::get('/', function () {
    return view('frontend.home.index');
});

//-----------------------------------User or Customer----------------------------

Route::middleware('auth')->group(function () {
    Route::get('/dashboard',[UserController::class,'UserDashboard'])->name('user.dashboard');

    //FilePond
    Route::post('/user/tmp-upload',[UserController::class,'TempUpload'])->name('user.photo.upload');
    Route::delete('/user/tmp-delete',[UserController::class,'TempRemove'])->name('user.photo.remove');

    Route::get('/user/logout',[UserController::class,'UserLogout'])->name('user.logout');
    Route::post('user/save_password',[UserController::class,'SavePassword'])->name('user.password.save'); 
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//-----------------------------------Admin----------------------------
Route::get('admin/login',[AdminController::class,'AdminLogin'])->name('admin.login');

Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('admin/dashboard',[AdminController::class,'AdminDashboard'])->name('admin.dashboard');
    Route::get('admin/profile',[AdminController::class,'AdminProfile'])->name('admin.profile');
    Route::post('admin/profile/store',[AdminController::class,'AdminProfileStore'])->name('admin.profile.store');
    Route::get('admin/logout',[AdminController::class,'AdminLogout'])->name('admin.logout');

    //FilePond
    Route::post('admin/tmp-upload',[AdminController::class,'TempUpload'])->name('admin.photo.upload');
    Route::delete('admin/tmp-delete',[AdminController::class,'TempRemove'])->name('admin.photo.remove');

    Route::get('admin/change_password',[AdminController::class,'ChangePassword'])->name('admin.password');   
    Route::post('admin/save_password',[AdminController::class,'SavePassword'])->name('admin.password.save');
    
    //Brands Route
    Route::controller(BrandController::class)->group(function (){
        Route::get('admin/brands/all','ShowAllBrand')->name('brand.all');   
        Route::get('admin/brand/add','AddBrand')->name('brand.add');   
        Route::post('admin/brand/Store','StoreBrand')->name('brand.store');   
        Route::get('admin/brand/edit/{id}','EditBrand')->name('brand.edit');   
        Route::post('admin/brand/update','UpdateBrand')->name('brand.update');   
        Route::get('admin/brand/delete/{id}','DeleteBrand')->name('brand.delete');
    });   

});



//-----------------------------------Vendor----------------------------
Route::get('vendor/login',[VendorController::class,'VendorLogin'])->name('vendor.login');

Route::middleware(['auth','role:vendor'])->group(function(){
    Route::get('vendor/dashboard',[VendorController::class,'VendorDashboard'])->name('vendor.dashboard');
    Route::get('vendor/profile',[VendorController::class,'VendorProfile'])->name('vendor.profile');
    Route::post('vendor/profile/store',[VendorController::class,'VendorProfileStore'])->name('vendor.profile.store');
    Route::get('vendor/logout',[VendorController::class,'VendorLogout'])->name('vendor.logout');

    //FilePond
    Route::post('vendor/tmp-upload',[VendorController::class,'TempUpload'])->name('vendor.photo.upload');
    Route::delete('vendor/tmp-delete',[VendorController::class,'TempRemove'])->name('vendor.photo.remove');

    Route::get('vendor/change_password',[VendorController::class,'ChangePassword'])->name('vendor.password');   
    Route::post('vendor/save_password',[VendorController::class,'SavePassword'])->name('vendor.password.save');   
});

require __DIR__.'/auth.php';
