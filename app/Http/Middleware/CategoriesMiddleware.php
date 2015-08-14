<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;

class CategoriesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->session()->forget('root_categories');
        $categories= $request->session()->get('root_categories');
        if (!isset($categories)) {
            $request->session()->put('root_categories', Category::where('parent_id', null)->get());
        }
        return $next($request);
    }
}
