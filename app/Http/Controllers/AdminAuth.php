<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminAuth extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/dashboard';

    protected $guard = 'admin'; // Spécifiez le garde pour l'authentification des administrateurs

    public function __construct(){
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm(){
        return view('admin.auth.login');
    }


}
