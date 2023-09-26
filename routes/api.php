<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MobileApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::namespace('\App\Http\Controllers\API')->group(function() {
    /*
    |--------------------------------------------------------------------------
    | Auth Route
    |--------------------------------------------------------------------------
    */
    Route::controller(AuthController::class)->prefix('auth')->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('forgot_password', 'forgotPass');
        Route::post('reset_password', 'resetPass');
    });
});

Route::middleware('auth:sanctum')->namespace('\App\Http\Controllers\API')->group(function () {
    /*
        |--------------------------------------------------------------------------
        | Auth Route
        |--------------------------------------------------------------------------
        */
    Route::controller(AuthController::class)->prefix('auth')->group(function () {
        Route::get('view', 			'view' 	 	 );
        Route::post('update', 		'update' 	 );
        Route::post('changePass', 	'changePass' );
        Route::get('logout', 		'logout' 	 );
    });
});


Route::controller(MobileApiController::class)->group(function () {
	/*
	|--------------------------------------------------------------------------
	| Wolfaram Routes
	|--------------------------------------------------------------------------
	| All route related to wolfarma api
	*/
	Route::group(['prefix' => 'token'], function (){
    	Route::get('list',		'apiTokenList' );
    	Route::post('edit',		'apiTokenUpdate' );
    });

	/*
	|--------------------------------------------------------------------------
	| Questionner Routes
	|--------------------------------------------------------------------------
	| All route related to Questionner api
	*/
	Route::group(['prefix' => 'questionner'], function (){
    	Route::get('topics',		'topicList');
    	Route::get('quizez/{id}',	'quizList' );
    });
});
