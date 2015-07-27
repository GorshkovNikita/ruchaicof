<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use App\User;
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
            $users = User::all();
            return view('admin.main')->with('users', $users);
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
