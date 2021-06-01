<?php

namespace App\Http\Controllers\Ajax;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $authSuccess = Auth::attempt($credentials);

        if($authSuccess) {
            $request->session()->regenerate();
            $user = Auth::user();

            return response()->json([
                'success'=>'Inicio de sesión correcto'
            ]);
        }

        $existe_user = User::where('email', $request['email'])->first();

        if (!($existe_user == NULL)) {
          return response()->json(['error'=>'La contraseña es incorrecta, ¿Has olvidado la contraseña?']);
        }else {
          return response()->json(['error'=>'No se reconoce al usuario. ¿Querés registrarte?']);
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $request->session()->invalidate();

        Auth::logout();

        if($request->ajax()) {
            return response()->json(array(
                'success' => true,
                'data'   => 'Éxito'
            ));
        }
        else {
            return redirect(route('login'));
        }
    }

    protected function username() {
       return 'email';
    }
}
