<?php

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

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('signup/activate/{token}', 'AuthController@signupActivate');

Route::group(['middleware' => ['auth']], function () {
	Route::get('/manage', function () {
		// $newrole = Auth::user()->roles;
		// foreach ($newrole as $name) {
		// 	$rolename = $name->name;
		// }
		// return view('welcome', compact('rolename'));
		return view('welcome');
	});

	Route::resource('users', 'UserController');
	Route::resource('clients', 'ClientController');
	Route::resource('receipts', 'ReceiptController');
	Route::resource('loans', 'LoanController');

	Route::post('/saveNok/{id}', 'ClientController@saveNok')->name('saveNok');
	Route::post('/updateNok/{id}', 'ClientController@updateNok')->name('updateNok');
	Route::post('/ArchivedClients/{id}', 'ClientController@ArchivedClients')->name('ArchivedClients');

	Route::post('/referee/{id}', 'LoanController@referee')->name('referee');
	Route::post('/loans/{id}', 'LoanController@loans')->name('loans');
	Route::post('/getLoans', 'LoanController@getLoans')->name('getLoans');
	Route::post('/getReferees', 'LoanController@getReferees')->name('getReferees');
	Route::post('/getAppliedLoans', 'LoanController@getAppliedLoans')->name('getAppliedLoans');
	Route::post('/getDefaultedLoans', 'LoanController@getDefaultedLoans')->name('getDefaultedLoans');
	Route::post('/getRejectedLoans', 'LoanController@getRejectedLoans')->name('getRejectedLoans');
	Route::post('/getRepayedLoans', 'LoanController@getRepayedLoans')->name('getRepayedLoans');
	Route::post('/getDraftLoans', 'LoanController@getDraftLoans')->name('getDraftLoans');
	Route::post('/getRepayedLoans', 'LoanController@getRepayedLoans')->name('getRepayedLoans');

	Route::post('/getUsers', 'UserController@getUsers')->name('getUsers');
	// Route::post('/profile/{id}', 'UserController@profile')->name('profile');
	// Route::post('/userUpdate', 'UserController@userUpdate')->name('userUpdate');
	// Route::post('/fewUsers', 'UserController@fewUsers')->name('fewUsers');
	// Route::post('/getRoles', 'UserController@getRoles')->name('getRoles');
	// Route::post('/getClient', 'UserController@getClient')->name('getClient');
	// Route::post('/getAdmin', 'UserController@getAdmin')->name('getAdmin');

	Route::post('/getArchivedClients', 'ClientController@getArchivedClients')->name('getArchivedClients');
	Route::post('/getClients', 'ClientController@getClients')->name('getClients');
	Route::post('/getReceipts', 'ReceiptController@getReceipts')->name('getReceipts');
});