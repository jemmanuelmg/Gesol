<?php

namespace Gesol\Http\Controllers\resetPassword;

use Illuminate\Http\Request;
use Gesol\Http\Controllers\Controller;

//Trait
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

//Password Broker Facade
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    //Sends Password Reset emails
    use SendsPasswordResetEmails;

    public function __construct() {
        $this->middleware('guest'); 
    }

    //Shows form to request password reset
    public function showLinkRequestForm()
    {
        return view('resetPassword.email');
    }

    //Password Broker for Seller Model
    public function broker()
    {
         return Password::broker('users');
    }

}
