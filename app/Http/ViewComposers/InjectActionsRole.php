<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Request;

class InjectActionsRole
{
	protected $user_auth;

	public function __construct()
	{
		$this->user_auth = \Auth::user();
	}


	public function compose(View $view)
	{
		$role_actions = [];

		if($this->user_auth != NULL){
				// admin
			if($this->user_auth->hasRole('administrador') == true ){
				array_push($role_actions, 'editar');
				array_push($role_actions, 'crear');
				array_push($role_actions, 'imprimir');
				array_push($role_actions, 'eliminar');

			}else{
				$role_actions = ['ver', 'imprimir'];
			}
		}

		$view->with('role_actions', $role_actions);
	}
}
