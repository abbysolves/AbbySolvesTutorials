<?php

//for unauthenticated routes 

Route::group(['module' => 'Admin' , 'prefix' => 'Admin' ,'middleware' => ['web'] , 'namespace' => 'App\Modules\Admin\Controllers'], function(){

	Route::get('/', array('as' => 'admin.signin' ,'uses' => 'LoginController@showSigninForm'));
    Route::get('/signin', array('as' => 'admin.signin' ,'uses' => 'LoginController@showSigninForm'));
    Route::post('/signin', array('as' => 'admin.signin' ,'uses' => 'LoginController@signin'));
    Route::get('/signout', array('as' => 'admin.signout' ,'uses' => 'LoginController@signout'));
  
});


//for authenticated routes

Route::group(['module' => 'Admin' , 'prefix' => 'Admin' ,'middleware' => ['web','admin'] , 'namespace' => 'App\Modules\Admin\Controllers'], function(){

	  Route::get('/dashboard', array('as' => 'admin.dashboard' ,'uses' => 'DashboardController@index'));

	
});

?>