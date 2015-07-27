<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;

/**
 * Class Authenticate
 * @package App\Http\Middleware
 * В моем случае этот класс отвечает за редирект администраторской панели,
 * так как для обычных юзеров редирект не нужен.
 */
class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Изначально было в фреймворке
        /*if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth/login');
            }
        }

        return $next($request);
        */

        if ($this->auth->check() && $this->auth->user()->role == 'admin') {
            return $next($request);
        }
        elseif ($this->auth->user() != null && $this->auth->user()->role != 'admin') {
            $this->auth->logout();
            return Redirect::to('admin/login')->withErrors('Необходимо авторизироваться в качестве администратора.');
        }
        else {
            return Redirect::to('admin/login');
        }

    }
}
