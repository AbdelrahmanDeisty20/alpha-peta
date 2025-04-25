<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Models\Contact;
use App\Models\Regulation;
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

// Route::get('/', function () {
//     return view('web.home');
// });

// Auth::routes();

Route::group(['namespace' => 'web','middleware'=>'setLang'], function () {
    //home page
    Route::get('/', [HomeController::class, 'index'])->name('web.home');

    //about us page
    Route::get('about_us', [HomeController::class, 'about'])->name('web.about');

    //blogs page
    Route::get('blogs', [BlogController::class, 'blog'])->name('web.blog');
    Route::get('blog/details/{id}', [BlogController::class, 'blogDetails'])->name('web.blogDetails');

    //conatct us page
    Route::get('contact', [ContactController::class, 'contact'])->name('web.contact');
    Route::post('contact-request', [ContactController::class, 'store'])->name('web.store');

    //artner page
    Route::get('partners', [HomeController::class, 'partner'])->name('web.partner');

    //services page
    Route::get('services', [ServiceController::class, 'service'])->name('web.service');
    Route::get('service/details/{id}', [ServiceController::class, 'aboutService'])->name('web.aboutService');

    // projects page
    Route::get('projects', [ProjectController::class, 'project'])->name('web.project');
    Route::get('project/details/{id}', [ProjectController::class, 'projectDetails'])->name('web.projectDetails');

    //regulation page
    Route::get('reulations',[HomeController::class,'regulation'])->name('web.regulation');

    //order services
    Route::post('/refresh-code', [OrderController::class,'refreshCode'])->name('web.refreshCode');
    Route::get('order-service/{id}', [OrderController::class, 'orderservice'])->name('web.orde-Service');
    Route::post('order-request', [OrderController::class,'store'])->name('web.serviceOrdr');

    //lang
    Route::get('/lang/{lang}',[HomeController::class,'lang'])->name('lang');
});
