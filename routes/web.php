<?php

use App\Http\Middleware\EnsureUserIsDoctor;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\UserController;
use Illuminate\Console\View\Components\Mutators\EnsurePunctuation;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\SocialAuthController;

route::get('/', function(){
    return view('dashboards/dashboards.index'); 
});

Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);



Route::get('login-form', [UserController::class, 'loginForm'])->name('loginForm');
Route::post('login', [UserController::class, 'login'])->name('login');
Route::get('logout',[UserController::class, 'logout'])->name('logout');
Route::get('/register',function(){
    return view('register');
})->name('register.form');
Route::post('/register', [UserController::class, 'store'])->name('user.store');



route::middleware([EnsureUserIsDoctor::class])->group(function(){
    // Simple dashboard view route (static page)
    Route::get('/', [DashboardController::class, 'index']);

    // RESTful Doctor routes
    Route::resource('doctors', DoctorController::class);

    // Optional delete route (not RESTful, use with caution)
    Route::get('/doctors/remove/{id}', [DoctorController::class, 'destroy'])->name('doctors.remove');

    // Dashboard Controller routes (if you want full REST)
    Route::resource('dashboards', DashboardController::class);
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboards.index');


});


