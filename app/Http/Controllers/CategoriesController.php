<?php

namespace App\Http\Controllers;

use App\Category;
use App\Property;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Schema;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function getIndex()
    {
        $categories = Category::all();

        return view('admin.category.categories')
            ->with('categories', $categories);
    }

    public function getAdd()
    {
        return view('admin.category.add');
    }

    public function postAdd(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator->messages())
                ->withInput();
        }

        $category = new Category();

        $category->name = $request->input('name');
        $category->table_name = $request->input('table_name');
        if ($request->input('parent_id') != "")
            $category->parent_id = $request->input('parent_id');
        $category->description = $request->input('description');
        $category->final = $request->input('final');
        $category->num_columns = $request->input('num_columns');

        $file = $request->file('image');
        $imageExtension = $file->getClientOriginalExtension();
        $imageName = $category->table_name . '.' . $imageExtension;

        $request->file('image')->move(
            base_path() . '/public/images/categories/', $imageName
        );

        $category->image = 'images/categories/' . $imageName;

        $category->save();

        if ($category->final == 0) {
            $msg = "Категория \"" . $category->name . "\" добавлена.";
            $request->session()->flash('msg', $msg);
            return Redirect::to('admin/category');
        }
        else
            return Redirect::to('admin/category/addcolumns');

    }

    public function getAddcolumns()
    {
        $category = Category::orderBy('created_at', 'desc')->first();
        $properties = Property::all();
        return view('admin.category.add_columns')
            ->with('num', $category->num_columns)
            ->with('properties', $properties);
    }

    public function postAddcolumns(Request $request)
    {
        $category = Category::orderBy('created_at', 'desc')->first();

        $propertyIDs = $request->except('_token');

        Schema::create($category->table_name, function(Blueprint $table) use ($category, $request, $propertyIDs)
        {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            foreach($propertyIDs as $propertyID) {
                $property = Property::find($propertyID);
                switch ($property->type) {
                    case 0:
                        $table->integer($property->real_name);
                        break;
                    case 1:
                        $table->string($property->real_name);
                        break;
                    case 2:
                        $table->text($property->real_name);
                        break;
                }
            }
            $table->timestamps();
        });

        Schema::table($category->table_name, function(Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('Products');
        });

        return Redirect::to('admin/category');
    }

    public function getShow($id)
    {
        //
    }

    public function getEdit($id = null)
    {
        $category = Category::find($id);

        if ($category != null)
            return view('admin.category.edit')->with('category', $category);
        else
            // TODO: исправить это на вывод сообщения о том, что категории не существует, если будет необходимо
            return Redirect::to('admin/category');
    }

    public function postEdit($id)
    {

    }

    public function postDelete($id)
    {
        $category = Category::find($id);

        if ($category != null) {
            // TODO: когда в таблице продуктов появятся записи, продумать удаление этих записей
            Schema::drop($category->table_name);
            $category->delete();
            return Redirect::back();
        }
        else
            // TODO: исправить это на вывод сообщения о том, что категории не существует, если будет необходимо
            return Redirect::to('admin/category');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'table_name' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'description' => 'required',
            'image' => 'required'
        ]);
    }
}
