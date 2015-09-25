<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use DB;
use Slug;
use Schema;
use App\Property;
use App\News;
use App\Offer;
use App\About;

class HomeController extends Controller
{
    public function getIndex()
    {
        return view('home.main');
    }

    public function getProducts(Request $request, $subcategory = null)
    {
        if ($subcategory == null) {

            if (null != $request->input('id')) {
                $product = Product::where('id', $request->input('id'))->first();

                if ($product == null)
                    return redirect('products');

                $category = Category::where('id', $product->category_id)->first();
                $productWIthProperties = DB::table('products')
                    ->join($category->table_name, 'products.id', '=', $category->table_name . '.product_id')
                    ->select('products.*', $category->table_name . '.*')
                    ->where('products.id', '=', $request->input('id'))
                    ->first();

                $columns = Schema::getColumnListing($category->table_name);
                // здесь удаляются имена ненужных столбцов:
                // id, product_id, created_at, updated_at
                array_splice($columns, 0, 2);
                array_splice($columns, count($columns) - 2, 2);

                $properties = [];
                foreach($columns as $column) {
                    $property = Property::where('real_name', $column)->first();
                    array_push($properties, $property);
                }

                return view('home.product')
                    ->with([
                        'product' => $productWIthProperties,
                        'properties' => $properties
                    ]);
            }

            $categories = Category::where('parent_id', null)->where('type', 0)->paginate(6); //->get();
            return view('home.categories')
                ->with([
                    'categories' => $categories,
                    'pageTitle' => 'Наша продукция'
                ]);
        }
        else {
            $parent = Category::where('table_name', $subcategory)->first();
            if ($parent->final == 0) {
                $categories = Category::where('parent_id', $parent->id)->paginate(6); //->get();
                return view('home.categories')
                    ->with([
                        'categories' => $categories,
                        'pageTitle' => $parent->name
                    ]);
            }
            else {
                $products = Product::where('category_id', $parent->id)->paginate(6); //->get();
                return view('home.products')
                    ->with([
                        'products' => $products,
                        'pageTitle' => $parent->name
                    ]);
            }
        }
    }

    public function getAbout(Request $request)
    {
        if ($request->input('id') == null) {
            $news = News::all();
            $about = About::first();
            return view('home.about')
                ->with([
                    'news' => $news,
                    'about' => $about
                ]);
        }
        else {
            $item = News::where('id', $request->input('id'))->first();
            if ($item == null)
               return redirect('about');
            return view('home.news')
                ->with('item', $item);
        }
    }

    public function getOffers(Request $request)
    {
        if ($request->input('id') == null) {
            $offers = Offer::all();
            return view('home.offers')
                ->with('offers', $offers);
        }
        else {
            $offer = Offer::where('id', $request->input('id'))->first();
            if ($offer == null)
                return redirect('offers');
            return view('home.offer')
                ->with('offer', $offer);
        }
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

                if ($recipe == null)
                    return redirect('recipes');

                return view('home.recipe')
                    ->with('recipe', $recipe);
            }

            $categories = Category::where('parent_id', null)->where('type', 1)->paginate(6);//->get();
            return view('home.categories')
                ->with([
                    'categories' => $categories,
                    'pageTitle' => 'Рецепты'
                ]);
        }
        else {
            $parent = Category::where('table_name', $subcategory)->first();

            if ($parent == null)
                return redirect('recipes');

            if ($parent->final == 0) {
                $categories = Category::where('parent_id', $parent->id)->paginate(6);//->get();
                return view('home.categories')
                    ->with([
                        'categories' => $categories,
                        'pageTitle' => $parent->name
                    ]);
            }
            else {
                $recipes = Recipe::where('category_id', $parent->id)->paginate(6);//->get();
                return view('home.recipes')
                    ->with([
                        'recipes' => $recipes,
                        'pageTitle' => $parent->name
                    ]);
            }
        }
    }
}
