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


class ProductsController extends Controller
{
    public function getIndex($id = null)
    {
        if ($id == null)
            return view('admin.product.products');
        else {
            $product = Product::find($id);
            return view('admin.product.product')
                ->with('product', $product);
        }
    }

    public function getAdd()
    {
        $categories = Category::where('final', 1)->get();
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
        $imageName = $product->name . '.' . $imageExtension;
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

        if (!isset($product)) {
            return redirect('admin/product/add');
        }

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
        $product->save();
        $properties = session('properties');
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

    }

    public function postEdit($id)
    {

    }

    public function postDelete(Request $request, $id)
    {

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'category_id' => 'required',
            'short_description' => 'required|max:255',
            'description' => 'required',
            'image' => 'required'
        ]);
    }
}