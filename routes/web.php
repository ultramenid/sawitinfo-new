<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NgopiniController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PolicyRegulationContoller;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\checksession;
use App\Http\Middleware\hasSession;
use App\Http\Middleware\PostController;
use App\Http\Middleware\setLanguage;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/cms/login');

Route::middleware([checksession::class])->group(function () {
    Route::get('/cms/dashboard', [DashboardController::class, 'index']);
    Route::get('/cms/pages/whoweare', [PagesController::class, 'whoweare']);
    Route::get('/cms/pages/sawitinfo', [PagesController::class, 'sawitinfo']);
    Route::get('/cms/cmsposts', [PostsController::class, 'index']);
    Route::get('/cms/addposts', [PostsController::class, 'add']);
    Route::get('/cms/editposts/{id}', [PostsController::class, 'edit']);
    Route::get('/cms/cmsreports', [ReportController::class, 'cmsreports']);
    Route::get('/cms/addreports', [ReportController::class, 'addreports']);
    Route::get('/cms/editreports/{id}', [ReportController::class, 'edit']);
    Route::get('/cms/cmspolicy', [PolicyRegulationContoller::class, 'cmsPolicy']);
    Route::get('/cms/addpolicy', [PolicyRegulationContoller::class, 'addPolicy']);
    Route::get('/cms/editpolicy/{id}', [PolicyRegulationContoller::class, 'edit']);


    Route::group(['prefix' => 'cms/sawit-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

});

Route::middleware([setLanguage::class])->group(function () {
    Route::group(['prefix' => '{lang}'], function () {
        Route::get('/', [IndexController::class, 'index'])->name('index');
        Route::get('/posts/{slug}', [PostsController::class, 'slug'])->name('slug');
        Route::get('/ngopini/{slug}', [NgopiniController::class, 'index'])->name('ngopini');
        Route::get('/insights', [PostsController::class, 'posts'])->name('insights');
        Route::get('/ngopinis', [NgopiniController::class, 'ngopinis'])->name('ngopinis');
        Route::get('/reports', [ReportController::class, 'reports'])->name('reports');
        Route::get('/about', [PagesController::class, 'index'])->name('about');
        Route::get('/whoweare', [PagesController::class, 'whoweare'])->name('whoweare');
        Route::get('/about/sawitinfo', [PagesController::class, 'pageSawitinfo'])->name('sawitinfo');
        Route::get('/about/whoweare', [PagesController::class, 'pageWhoweare'])->name('whoweare');
        Route::get('/policyregulation', [PolicyRegulationContoller::class, 'index'])->name('policyregulation');
    });
});




//if there is no session , redirect to login page
Route::middleware([hasSession::class])->group(function () {
    Route::get('cms/login', [LoginController::class, 'index'])->name('login');
});

//route logout
Route::get('/cms/logout', function () {
    session()->flush();
    return redirect('/cms/login');
});

Route::any('{query}', function() { return redirect('/'); })->where('query', '.*');
