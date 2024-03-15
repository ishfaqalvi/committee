<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Committee Routes
|--------------------------------------------------------------------------
*/
Route::group(['as' => 'committees.', 'controller' => CommitteeController::class], function () {
    Route::get('list',					 'index'	   	  )->name('index'  		   );
	Route::get('create',				 'create'   	  )->name('create' 		   );
	Route::post('store',				 'store'	   	  )->name('store'  		   );
	Route::get('edit/{id}',				 'edit'	   		  )->name('edit'	  	   );
	Route::get('show/{id}',				 'show'	   		  )->name('show'	  	   );
	Route::patch('update/{committee}',	 'update'   	  )->name('update' 		   );
	Route::patch('publish/{committee}',  'publish'  	  )->name('publish'		   );
	Route::delete('delete/{id}',		 'destroy'  	  )->name('destroy'		   );
	Route::post('check_days',			 'checkDays'	  )->name('checkDays'	   );
});

/*
|--------------------------------------------------------------------------
| Members Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'members',
    'as'         => 'committees.members.',
    'controller' => MemberController::class
], function () {
    Route::get('list/{id}',         	'index'  	 )->name('index'  	);
	Route::get('search',				'search' 	 )->name('search'	);
    Route::post('store',				'store'	 	 )->name('store'  	);
	Route::post('update',				'update' 	 )->name('update' 	);
	Route::patch('submission/{member}',	'submission' )->name('submit' 	);
	Route::delete('delete/{id}',		'destroy'	 )->name('destroy'	);
});

/*
|--------------------------------------------------------------------------
| Submission Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'submissions',
    'as'         => 'committees.submissions.',
    'controller' => SubmissionController::class
], function () {
    Route::get('list/{id}',           	'index'  	)->name('index'  	);
    Route::post('store',				'store'	   	)->name('store'  	);
	Route::patch('update/{submission}',	'update'   	)->name('update' 	);
	Route::delete('delete/{id}',		'destroy'  	)->name('destroy'	);
	Route::post('check_order',			'checkOrder')->name('checkOrder');
}); 

/*
|--------------------------------------------------------------------------
| Payments Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'payments',
    'as'         => 'committees.payments.',
    'controller' => PaymentController::class
], function () {
    Route::get('list/{id}',           	'index'  	)->name('index'  	);
	Route::patch('update/{payment}',	'update'   	)->name('update' 	);
});

/*
|--------------------------------------------------------------------------
| Payments Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'accounts',
    'as'         => 'committees.accounts.',
    'controller' => AccountController::class
], function () {
    Route::get('list/{id}',           	'index'  	)->name('index'  	);
	Route::patch('update/{payment}',	'update'   	)->name('update' 	);
}); 