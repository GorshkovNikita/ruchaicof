<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use Validator;
use App\Product;
use App\Category;
use Schema;
use DB;
use Slug;


class ProductsController extends Controller
{
    public function getIndex($id = null)
    {
        if ($id == null) {
            $products = DB::table('products')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->select('products.*', 'categories.name as category_name')
                ->get();
            return view('admin.product.products')
                ->with('products', $products);
        }
        else {
            $product = Product::find($id);
            return view('admin.product.product')
                ->with('product', $product);
        }
    }

    public function getAdd()
    {
        $categories = Category::where('final', 1)->where('type', 0)->get();
        return view('admin.product.add')
            ->with('categories', $categories);
    }

    public function postAdd(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator->messages())
                ->withInput();
        }

        $product = new Product();

        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->short_description = $request->input('short_description');
        $product->description = $request->input('description');

        $file = $request->file('image');
        $imageExtension = $file->getClientOriginalExtension();
        $imageName = Slug::make($product->name) . '.' . $imageExtension;
        $request->file('image')->move(
            base_path() . '/public/images/products/', $imageName
        );

        $product->image = $imageName;

        //$product->save();

        return redirect('admin/product/addproperties')
            ->with('product', $product);
    }

    public function getAddproperties(Request $request)
    {
        $product = session('product');

        if (!isset($product))
            return redirect('admin/product/add');

        $request->session()->flash('product', $product);
        $category = Category::where('id', $product->category_id)->first();
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
        $request->session()->flash('properties', $properties);
        return view('admin.product.add_properties');
    }

    public function postAddproperties(Request $request)
    {
        $product = session('product');
        if ($product == null)
            return redirect('admin/product/add');
        $product->save();
        //$properties = session('properties');
        $category = Category::where('id', $product->category_id)->first();
        $data = $request->except('_token');
        $data = array_merge(['id' => 0, 'product_id' => $product->id], $data);
        DB::table($category->table_name)->insert($data);
        $msg = "Продукт \"" . $product->name . "\" добавлен";
        return redirect('admin/product')
            ->with('msg', $msg);
    }

    public function getEdit($id)
    {
        $product = Product::where('id', $id)->first();

        if ($product == null) {
            $msg = "Продукта с id=" . $id . " не существует.";
            return redirect('admin/product')
                ->with('msg', $msg);
        }

        $category = Category::where('id', $product->category_id)->first();
        $query = DB::table('products')
            ->join($category->table_name, 'products.id', '=', $category->table_name . '.product_id')
            ->select('products.*');

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

        foreach($columns as $column) {
            $query->addSelect($category->table_name . '.' . $column);
        }

        $productWIthProperties = $query->where('products.id', '=', $id)->first();

        return view('admin.product.edit')
            ->with([
                'product' => $productWIthProperties,
                'properties' => $properties
            ]);
    }

    public function postEdit(Request $request, $id)
    {
        $validator = $this->validatorForEdit($request->all(), $id);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->messages())
                ->withInput();
        }

        $product = Product::find($id);
        $category = Category::where('id', $product->category_id)->first();
        $columns = Schema::getColumnListing($category->table_name);
        // здесь удаляются имена ненужных столбцов:
        // id, product_id, created_at, updated_at
        array_splice($columns, 0, 2);
        array_splice($columns, count($columns) - 2, 2);

        /*$rusColumns = [];

        foreach($columns as $column) {
            array_push($rusColumns, Property::where('real_name', $column)->first());
        }*/

        $product->name = $request->input('name');
        $product->short_description = $request->input('short_description');
        $product->description = $request->input('description');

        if ($request->hasFile('image')) {
            $request->file('image')->move(
                base_path() . '/public/images/products/' , $product->image
            );
        }

        foreach($columns as $column) {
            DB::table($category->table_name)
                ->where('product_id', $product->id)
                ->update([$column => $request->input($column)]);
        }

        $product->save();

        $msg = "Продукт \"" . $product->name . "\" изменен.";

        return redirect('admin/product')
            ->with('msg', $msg);
    }

    public function postDelete(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();

        if ($product != null) {
            $product->delete();
            $msg = "Продукт \"" . $product->name . "\" удален.";
            return redirect('admin/product')
                ->with('msg', $msg);
        }
        else {
            $msg = "Продукта с id = " . $id . " не существует.";
            return redirect('admin/recipe')
                ->with('msg', $msg);
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:products',
            'category_id' => 'required',
            'short_description' => 'required|max:255',
            'description' => 'required',
            'image' => 'required'
        ]);
    }

    protected function validatorForEdit(array $data, $id)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:products,name,'.$id,
            'short_description' => 'required|max:255',
            'description' => 'required'
        ]);
    }
}