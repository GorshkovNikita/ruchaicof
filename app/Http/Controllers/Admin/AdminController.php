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
use App\Http\Middleware\Authenticate;

class AdminController extends Controller
{

    public function getIndex()
    {
        $users = User::all();
        return view('admin.main')->with('users', $users);
    }

    public function getLogin()
    {

        // логику проверки на авторизацию при запросе на страницу admin/login не стал выносить в middleware,
        // так как это всего одна страница, проще написать это здесь
        // Потом как-нибудь, возможно, вынесу в middleware.
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
