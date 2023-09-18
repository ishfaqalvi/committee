<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RoleController;


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



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


  
Route::group(['middleware' => ['auth']], function() {
	Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('managers', ManagerController::class);
    Route::resource('products', ProductController::class);

    /*
	|--------------------------------------------------------------------------
	| Audit Routes
	|--------------------------------------------------------------------------
	*/
	Route::controller(AuditController::class)->prefix('audits')->group(function () {
		Route::get('index', 		 'index')->name('audit.index');
		Route::get('show/{id}', 	 'show')->name('audit.show');
		Route::delete('destroy/{id}','destroy')->name('audit.destroy');
	});

	/*
	|--------------------------------------------------------------------------
	| Settings Routes
	|--------------------------------------------------------------------------
	*/
	Route::controller(SettingController::class)->prefix('settings')->group(function () {
		Route::get('index', 	'index'	)->name('settings.index');
		Route::post('save', 	'save'	)->name('settings.save');
	});

	/*
	|--------------------------------------------------------------------------
	| Error Log Route
	|--------------------------------------------------------------------------
	*/
	Route::get('logs', 
		[\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']
	)->name('logs');

});