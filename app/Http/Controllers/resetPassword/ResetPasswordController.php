<?php

namespace Gesol\Http\Controllers\resetPassword;

use Illuminate\Http\Request;
use Gesol\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;


class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    public function __construct() {
        $this->middleware('guest'); 
    }

    //Seller redirect path
    protected $redirectTo = '/';

    //trait for handling reset Password
    use ResetsPasswords;

    //Show form to seller where they can reset password
    public function showResetForm(Request $request, $token = null)
    {
        return view('resetPassword.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    //returns Password broker of seller
    public function broker()
    {
        return Password::broker('users');
    }
    
}
