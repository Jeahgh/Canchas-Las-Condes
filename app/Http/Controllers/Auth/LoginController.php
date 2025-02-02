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
        try {
            $credentials = $request->validate([
                'rut' => 'required',
                'password' => 'required',
            ]);
    
            $credentials['estado'] = '1';
    
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }
    
            return back()
                ->withErrors(['rut' => 'Las credenciales son incorrectas.'])
                ->withInput();
        } 
        catch (\Throwable $th) {
            return back()
                ->withErrors(['error' => 'Ocurrió un error al intentar iniciar sesión.'])
                ->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
