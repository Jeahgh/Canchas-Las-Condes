<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

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
                'rut' => $request->rut,
                'password' => $request->password,
                'estado' => '1'
            ]);
   
            //  //Primero verificamos si el usuario existe y su estado
            // $user = User::where('rut', $request->rut)->first();
           
            //  //Si el usuario existe y está deshabilitado, no permitimos el login
            // if ($user && $user->estado === 0) {
            //     return back()
            //         ->withErrors(['rut' => 'Esta cuenta está deshabilitada. Contacta al administrador.'])
            //         ->withInput();
            // }
   
             //Si el usuario está habilitado, intentamos autenticar
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }
   
             //Si las credenciales son incorrectas
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
