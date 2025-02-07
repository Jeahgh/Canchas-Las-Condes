<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->only('rut', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // verifica si el usario esta deshabilitado
            if ($user->estado === false) {
                Auth::logout();
                return back()->withErrors([
                    'rut' => 'Su cuenta está deshabilitada. Por favor, contacte a un administrador.'
                ]);
            }
    
            return redirect()->intended('/canchas');
        }
    
        return back()->withErrors([
            'rut' => 'Las credenciales proporcionadas no coinciden con nuestros registros.'
        ]);


    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
