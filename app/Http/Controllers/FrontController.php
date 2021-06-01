<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
    	if(\Auth::check())
    		return redirect(route('panel.index'));

    	return view('auth.login');
    }
}
