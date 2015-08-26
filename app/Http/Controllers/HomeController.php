<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;

class HomeController extends Controller
{
    public function getIndex()
    {
        return view('home.main');
    }

    public function getAbout($type = null)
    {
        return view('home.about');
    }

    public function getProducts($subcategory = null)
    {
        if ($subcategory == null) {
            $categories = Category::where('parent_id', null)->where('type', 0)->get();
            return view('home.categories')
                ->with([
                    'categories' => $categories,
                    'pageTitle' => 'Наша продукция'
                ]);
        }
        else {
            $parent = Category::where('table_name', $subcategory)->first();
            if ($parent->final == 0) {
                $categories = Category::where('parent_id', $parent->id)->get();
                return view('home.categories')
                    ->with([
                        'categories' => $categories,
                        'pageTitle' => $parent->name
                    ]);
            }
            else {
                $products = Product::where('category_id', $parent->id)->get();
                return view('home.products')
                    ->with([
                        'products' => $products,
                        'pageTitle' => $parent->name
                    ]);
            }
        }
    }

    public function getOffers()
    {
        return view('home.offers');
    }

    public function getContacts()
    {
        return view('home.contacts');
    }

    public function getRecipes(Request $request, $subcategory = null)
    {
        if ($subcategory == null) {

            if (null != $request->input('id')) {
                $recipe = Recipe::where('id', $request->input('id'))->first();
                return view('home.recipe')
                    ->with('recipe', $recipe);
            }

            $categories = Category::where('parent_id', null)->where('type', 1)->get();
            return view('home.categories')
                ->with([
                    'categories' => $categories,
                    'pageTitle' => 'Рецепты'
                ]);
        }
        else {
            $parent = Category::where('table_name', $subcategory)->first();
            if ($parent->final == 0) {
                $categories = Category::where('parent_id', $parent->id)->get();
                return view('home.categories')
                    ->with([
                        'categories' => $categories,
                        'pageTitle' => $parent->name
                    ]);
            }
            else {
                $recipes = Recipe::where('category_id', $parent->id)->get();
                return view('home.recipes')
                    ->with([
                        'recipes' => $recipes,
                        'pageTitle' => $parent->name
                    ]);
            }
        }
    }
}
