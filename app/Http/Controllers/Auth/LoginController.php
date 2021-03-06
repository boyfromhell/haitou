<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    // Max Attempts Until Lockout
    protected $maxAttempts = 5;
    // Minutes Lockout
    protected $decayMinutes = 60;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        // Get URLs
        $urlPrevious = url()->previous();
        $urlBase = url()->to('/');

        // Set the previous url that we came from to redirect to after successful login but only if is internal
        if (($urlPrevious != $urlBase . '/login') && (substr($urlPrevious, 0, strlen($urlBase)) === $urlBase)) {
            session()->put('url.intended', $urlPrevious);
        }

        return view('auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->status == 1) {
            auth()->logout();
            $request->session()->flush();
            return view('auth.login')->with('warning', 'Conta pendente ativação!');
        }
        if ($user->status == 3) {
            auth()->logout();
            $request->session()->flush();
            return view('auth.login')->with('info', 'Conta suspensa, tente novamente em outro dia!');
        }
        if ($user->status == 4) {
            auth()->logout();
            $request->session()->flush();
            return view('auth.login')->with('danger', 'Conta banida!');
        }
        if ($user->readed_rules == false) {
            toastr()->warning('Não se esqueça de ler as Regras.', 'Lembrete!');
        }
    }
}
