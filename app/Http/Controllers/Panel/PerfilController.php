<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index(){
    	$user_auth = \Auth::user();

        return view('panel.perfil.dashboard', compact('user_auth'));
    }
}
