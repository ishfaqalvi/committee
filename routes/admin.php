<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Route
|--------------------------------------------------------------------------
*/
Route::get('dashboard', DashboardController::class)->name('dashboard');

/*
|--------------------------------------------------------------------------
| Role Routes
|--------------------------------------------------------------------------
*/
Route::resource('roles', RoleController::class);

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::controller(UserController::class)->prefix('users')->as('users.')->group(function () {
	Route::get('list',				'index'			)->name('index'		   );
	Route::get('create',			'create'		)->name('create'	   );
	Route::post('store',			'store'			)->name('store'		   );
	Route::get('edit/{id}',			'edit'			)->name('edit'		   );
	Route::get('show/{id}',			'show'			)->name('show'		   );
	Route::patch('update/{user}',	'update'		)->name('update'	   );
	Route::delete('delete/{id}',	'destroy'		)->name('destroy'	   );
	Route::get('profile', 		 	'profileEdit'	)->name('profileEdit'  );
    Route::post('profile',		 	'profileUpdate'	)->name('profileUpdate');
    Route::post('check_email', 	 	'checkEmail'	)->name('checkEmail'   );
    Route::post('check_password',	'checkPassword'	)->name('checkPassword');
});

/*
|--------------------------------------------------------------------------
| Member Routes
|--------------------------------------------------------------------------
*/
Route::controller(MemberController::class)->prefix('members')->as('members.')->group(function () {
	Route::get('list',				'index'		 )->name('index'	  );
	Route::get('create',			'create'	 )->name('create'	  );
	Route::get('search',			'search'	 )->name('search'	  );
	Route::post('store',			'store'		 )->name('store'	  );
	Route::post('add',				'add'		 )->name('add'	  	  );
	Route::get('edit/{id}',			'edit'		 )->name('edit'		  );
	Route::get('show/{id}',			'show'		 )->name('show'		  );
	Route::patch('update/{user}',	'update'	 )->name('update'	  );
	Route::delete('delete/{id}',	'destroy'	 )->name('destroy'	  );
    Route::post('check_email', 	 	'checkEmail' )->name('checkEmail' );
    Route::post('check_phone',		'checkPhone' )->name('checkPhone' );
    Route::post('check_member',		'checkMember')->name('checkMember');
});

/*
|--------------------------------------------------------------------------
| Committee Routes
|--------------------------------------------------------------------------
*/
Route::prefix('/committees')->namespace('\App\Http\Controllers\Admin\Committee')->group(__DIR__.'/committee.php');

/*
|--------------------------------------------------------------------------
| Committee Routes
|--------------------------------------------------------------------------
*/
Route::controller(PaymentController::class)->prefix('payments')->as('payments.')->group(function () {
	Route::get('list',				'index'		 )->name('index'	  );
	Route::get('create',			'create'	 )->name('create'	  );
	Route::get('search',			'search'	 )->name('search'	  );
	Route::post('store',			'store'		 )->name('store'	  );
	Route::post('add',				'add'		 )->name('add'	  	  );
	Route::get('edit/{id}',			'edit'		 )->name('edit'		  );
	Route::get('show/{id}',			'show'		 )->name('show'		  );
	Route::patch('update/{user}',	'update'	 )->name('update'	  );
	Route::delete('delete/{id}',	'destroy'	 )->name('destroy'	  );
    Route::post('check_email', 	 	'checkEmail' )->name('checkEmail' );
    Route::post('check_phone',		'checkPhone' )->name('checkPhone' );
    Route::post('check_member',		'checkMember')->name('checkMember');
});

/*
|--------------------------------------------------------------------------
| Committee Types Routes
|--------------------------------------------------------------------------
*/
Route::controller(CommitteeTypeController::class)->prefix('committee-types')->as('committee-types.')->group(function () {
	Route::get('list',				'index'	 )->name('index'  );
	Route::get('create',			'create' )->name('create' );
	Route::post('store',			'store'	 )->name('store'  );
	Route::get('edit/{id}',			'edit'	 )->name('edit'	  );
	Route::patch('update/{type}',	'update' )->name('update' );
	Route::delete('delete/{id}',	'destroy')->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Notifications Routes
|--------------------------------------------------------------------------
*/
Route::controller(NotificationController::class)->prefix('notifications')->as('notifications.')->group(function () {
	Route::get('index', 		  	'index'  )->name('index'  );
	Route::get('show/{id}', 		'show'   )->name('show'	  );
	Route::delete('destroy/{id}', 	'destroy')->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Audit Routes
|--------------------------------------------------------------------------
*/
Route::controller(AuditController::class)->prefix('audits')->as('audits.')->group(function () {
	Route::get('index', 		 	'index'	 )->name('index'  );
	Route::get('show/{id}', 	 	'show'	 )->name('show'	  );
	Route::delete('destroy/{id}',	'destroy')->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Settings Routes
|--------------------------------------------------------------------------
*/
Route::controller(SettingController::class)->prefix('settings')->as('settings.')->group(function () {
	Route::get('index', 		'index'		)->name('index'		 );
	Route::get('clear-cache', 	'clearCache')->name('clear-cache');
	Route::post('save', 		'save'		)->name('save'		 );
});


/*
|--------------------------------------------------------------------------
| App String Routes
|--------------------------------------------------------------------------
*/
Route::resource('app-strings', AppStringController::class);

/*
|--------------------------------------------------------------------------
| Error Log Route
|--------------------------------------------------------------------------
*/
Route::get('logs',
	[\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']
)->name('logs');
