<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use Validator;
use App\Product;

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

    }

    public function postAdd(Request $request)
    {

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
}