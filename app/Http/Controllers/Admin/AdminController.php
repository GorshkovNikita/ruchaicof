<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    public function getIndex()
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('admin.main');
        }
        elseif (Auth::user() != null && Auth::user()->role != 'admin') {
            return Redirect::to('admin/login')->withErrors('Необходимо авторизироваться в качестве администратора.');
        }
        else {
            return Redirect::to('admin/login');
        }
    }

    public function getLogin()
    {

        if (Auth::check() && Auth::user()->role == 'admin') {
            return Redirect::to('admin');
        }
        elseif (Auth::check()) {
            Auth::logout();
            return view('admin.login')->withErrors('Необходимо авторизироваться в качестве администратора.');
        }
        else {
            return view('admin.login');
        }

    }

}
