<?php

namespace App\Http\Controllers;

use App\Models\Condition;
use App\Models\Magnitude;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
    	$resumen = [
    		(object)[
    			'id' 	 => '1',
    			'titulo' 	 => 'En espera',
    			'descripcion'=> 'Calibraciones',
    			'valor' 	 => '10',
    			'style'		 => [
    				'icon'  => 'fas fa-clock',
    				'color' => 'bg-warning'
    			]
    		],
    		(object)[
          'id' 	 => '2',
    			'titulo' 	 => 'En proceso',
    			'descripcion'=> 'Calibraciones',
    			'valor' 	 => '16',
    			'style'		 => [
    				'icon'  => 'fas fa-tools',
    				'color' => 'bg-primary'
    			]
    		],
    		(object)[
          'id' 	 => '3',
    			'titulo' 	 => 'Completadas',
    			'descripcion'=> 'Calibraciones',
    			'valor' 	 => '8',
    			'style'		 => [
    				'icon'  => 'fas fa-check',
    				'color' => 'bg-success'
    			]
    		],
    		(object)[
          'id' 	 => '4',
    			'titulo' 	 => 'Aprobada',
    			'descripcion'=> 'Calibraciones',
    			'valor' 	 => '10',
    			'style'		 => [
    				'icon'  => 'fas fa-certificate',
    				'color' => 'bg-info'
    			]
    		],
    		(object)[
          'id' 	 => '5',
    			'titulo' 	 => 'Facturada',
    			'descripcion'=> 'Calibraciones',
    			'valor' 	 => '5',
    			'style'		 => [
    				'icon'  => 'fas fa-receipt',
    				'color' => 'bg-success'
    			]
    		],
    		(object)[
          'id' 	 => '6',
    			'titulo' 	 => 'Anulada',
    			'descripcion'=> 'Calibraciones',
    			'valor' 	 => '10',
    			'style'		 => [
    				'icon'  => 'fas fa-times',
    				'color' => 'bg-danger'
    			]
    		],
    		(object)[
          'id' 	 => '7',
    			'titulo' 	 => 'En suspensión',
    			'descripcion'=> 'Calibraciones',
    			'valor' 	 => '1',
    			'style'		 => [
    				'icon'  => 'fas fa-pause',
    				'color' => 'bg-warning'
    			]
    		],
    		(object)[
          'id' 	 => '8',
    			'titulo' 	 => 'En revisión',
    			'descripcion'=> 'Calibraciones',
    			'valor' 	 => '3',
    			'style'		 => [
    				'icon'  => 'fas fa-clipboard-list',
    				'color' => 'bg-info'
    			]
    		],
    		(object)[
          'id' 	 => '9',
    			'titulo' 	 => 'Rechazada',
    			'descripcion'=> 'Calibraciones',
    			'valor' 	 => '4',
    			'style'		 => [
    				'icon'  => 'fas fa-redo',
    				'color' => 'bg-danger'
    			]
    		],
    		(object)[
          'id' 	 => '10',
    			'titulo' 	 => 'Prefacturado',
    			'descripcion'=> 'Calibraciones',
    			'valor' 	 => '7',
    			'style'		 => [
    				'icon'  => 'fas fa-clipboard-check',
    				'color' => 'bg-primary'
    			]
    		]
    	];

        $auth_user = Auth::user();

        // if($auth_user->hasRole('tecnico'))
        //     return redirect(route('panel.perfil.index'));

        return view('panel.index', compact('resumen'));
    }


    public function getCondition(){
        return response()->json(Condition::patron()->get());
    }


    public function getMagnitudes(){
        return response()->json(Magnitude::all());
    }


}
