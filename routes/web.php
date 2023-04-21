<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Role;
use App\Models\Departement;
use App\Models\Classification;
use App\Models\Rootcause;
use App\Models\Status;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardMyPostController;
use App\Http\Controllers\DashboardMyUserController;
use App\Http\Controllers\DashboardMyDeptPostController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CategoryAdminController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ChartController;

use App\Notifications\CapaNotification;
use App\Notifications\EmailNotification;

use Illuminate\Support\Facades\Notification;


Route::get('/', function () {
    return view('Login/index', [
        "title" => "Login",
        "active" => "login"
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');  
Route::resource('/dashboard/mypost', DashboardMyPostController::class)->middleware('auth');
Route::get('/dashboard/mypost/checkSlug', [DashboardMyPostController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/mydepartementpost', DashboardMyDeptPostController::class)->middleware('auth');
Route::get('/dashboard/mydepartementpost/checkSlug', [DashboardMyDeptPostController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/myuser', DashboardMyUserController::class)->middleware('auth');
    
Route::group(['middleware' => ['auth', 'CheckRole:3']], function(){
    Route::resource('/dashboard/users', AdminUserController::class);
    Route::get('/dashboard/chart', [ChartController::class, 'index']);
    Route::get('/dashboard/posts/checkSlug', [AdminPostController::class, 'checkSlug']);
    Route::resource('/dashboard/posts', AdminPostController::class)->middleware('auth');
    Route::delete("/dashboard/posts/delete", [AdminPostController::class, "deleteImage"])->name("delete");    
    Route::get('/dashboard/posts/fetch-users/{id}',[AdminPostController::class,'fetchUsers']);
    Route::get('/dashboard/posts/fetch-emails/{id}',[AdminPostController::class,'fetchEmails']);
});

