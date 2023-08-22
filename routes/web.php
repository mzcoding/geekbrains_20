<?php

use App\Http\Controllers\Account\IndexController as AccountController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\NewsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function() {
   Route::get('/account', AccountController::class)->name('account');
    //Admin
   Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'is.admin'], static function () {
      Route::get('/', AdminController::class)->name('index');
      Route::resource('/categories', AdminCategoryController::class);
      Route::resource('/news', AdminNewsController::class);
   });
});

//News
Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])
    ->where('id', '\d+')
    ->name('news.show');

Route::get('/test', function() {
   return response()->download('robots.txt');
});

Route::get('/collection', function () {
    $array = [1,4,6,79,07,786,890,7788];
    $collect = collect($array);
    dd($collect->map(fn ($item) => $item * 2)->chunk(3)->sortBy(function ($item) {
        return $item;
    })->toArray());
});

Route::get('/session', function () {
    $key = 'test';

    if (session()->has($key)) {
       // session()->forget($key);
        dd(session()->all(), session()->get($key));
    }

    session()->put($key, 'Some value');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
