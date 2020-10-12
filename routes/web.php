<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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


Route::group(['middleware'=>['customAuth']],function(){
	Route::view('/admin','dashboard');
	Route::resource('/admin/wing','WingC');
	Route::get('/admin/society-member','RegistrationC@society_member');
	Route::get('/admin/verify-society-member','RegistrationC@verify_society_member');
	Route::delete('/admin/verify-society-member/{id}','RegistrationC@destroy');
	Route::post('/admin/verify-society-member/{id}','RegistrationC@update');
	Route::resource('/admin/amenitie','AmenitieC');
	Route::resource('/admin/maintenance','MaintenanceC');
	Route::resource('/admin/service-type','Service_TypeC');
	Route::resource('/admin/service-provider','Service_ProviderC');
	Route::resource('/admin/broadcast-message','Broadcast_MessageC');
	Route::resource('/admin/wallet','WalletC');
});



Route::view('/login','login');
Route::get('/register','RegistrationC@index');

/*Route::get('/login',function(){
	return view('login');
});*/

Route::get('/logout',function(){
	session()->forget('udata');
	return redirect('/login');
});

Route::resource('ins_register','RegistrationC');

Route::post('chklogin','RegistrationC@chk_login');









Route::get('/mailsend',function(){
	$details = [
        'title' => 'This Is Title',
        'body' => 'This is body <br> Hellp'
    ];
   
    \Mail::to('happyjain474@gmail.com')->send(new \App\Mail\MyTestMail($details));
   /*
    dd("Email is Sent.");*/
});