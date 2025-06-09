<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\EbookController;
use App\Http\Controllers\Admin\StudentSubscriptionController;
use App\Http\Controllers\Auth\StudentLoginController;

use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome');


//dashboard routes
Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard', 'as' => 'admin.'], function () {
    //single action controllers
    Route::get('/', HomeController::class)->name('home');

    //link that return view, to get compoment from there
    Route::view('/buttons', 'admin.buttons')->name('buttons');
    Route::view('/cards', 'admin.cards')->name('cards');
    Route::view('/charts', 'admin.charts')->name('charts');
    Route::view('/forms', 'admin.forms')->name('forms');
    Route::view('/modals', 'admin.modals')->name('modals');
    Route::view('/tables', 'admin.tables')->name('tables');

    Route::group(['prefix' => 'pages', 'as' => 'page.'], function () {
        Route::view('/404-page', 'admin.pages.404')->name('404');
        Route::view('/blank-page', 'admin.pages.blank')->name('blank');
        Route::view('/create-account-page', 'admin.pages.create-account')->name('create-account');
        Route::view('/forgot-password-page', 'admin.pages.forgot-password')->name('forgot-password');
        Route::view('/login-page', 'admin.pages.login')->name('login');
    });

    Route::resource('ebooks', EbookController::class)->names([
        'index' => 'ebooks.index',
        'create' => 'ebooks.create',
        'store' => 'ebooks.store',
        'edit' => 'ebooks.edit',
        'update' => 'ebooks.update',
    ]);

    Route::resource('subscriptions',StudentSubscriptionController::class)->names([
    'index' => 'subscriptions.index',
    'create' => 'subscriptions.create',
    'store' => 'subscriptions.store',
    'edit' => 'subscriptions.edit',
    'update' => 'subscriptions.update',
]);

    Route::get('ebooks/{ebook}/view', [EbookController::class, 'view'])->name('ebooks.view');
    Route::get('/ebooks/{ebook}/secure-pdf', [EbookController::class, 'securePdf'])->name('ebooks.secure-pdf');


});

Route::middleware('student')->group(function () {
    Route::get('/student/dashboard', function () {
        $student = \App\Models\StudentSubscription::find(session('student'));
        return view('student.dashboard', compact('student'));
    })->name('student.dashboard');

    // Student Logout
    Route::post('/student/logout', function (Request $request) {
        $request->session()->forget('student');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('student.login')->with('success', 'Logged out successfully!');
    })->name('student.logout');
});
Route::get('/student/dashboard', [StudentLoginController::class, 'dashboard'])->name('student.dashboard');


require __DIR__ . '/auth.php';
