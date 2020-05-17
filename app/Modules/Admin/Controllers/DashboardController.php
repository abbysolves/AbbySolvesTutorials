<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;



class DashboardController extends Controller
{
	

	  /*
    |--------------------------------------------------------------------------
    | Dashboard Controller
    |--------------------------------------------------------------------------
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
    {
        
    }
    public function index(){


    	return view('Admin::dashboard.index');
    	}
}


?>