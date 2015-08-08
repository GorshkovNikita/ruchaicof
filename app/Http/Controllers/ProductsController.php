<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use Validator;
use App\Product;
use App\Category;
use Schema;


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
            ->with([
                'categories' => $categories,

            ]);
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

        $product->save();

        return redirect('admin/product/addproperties');
    }

    public function getAddproperties()
    {
       return view('admin.product.add_properties');
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
            'name' => 'required',
            'category_id' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);
    }
}