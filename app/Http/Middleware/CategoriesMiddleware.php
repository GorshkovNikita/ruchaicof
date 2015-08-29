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
            $request->session()->put('root_categories', Category::where('parent_id', null)->where('type', 0)->get());
        }

        $request->session()->forget('root_recipe_categories');
        $recipe_categories = $request->session()->get('root_recipe_categories');
        if (!isset($recipe_categories)) {
            $request->session()->put('root_recipe_categories', Category::where('parent_id', null)->where('type', 1)->get());
        }

        return $next($request);
    }
}
