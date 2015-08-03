<?php

namespace App\Http\Controllers;

use App\Category;
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

        $list = Schema::getColumnListing('Categories');

        return view('admin.category.categories')
            ->with(['categories' => $categories,
                    'list' => $list]);
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
        return view('admin.category.add_columns')->with('num', $category->num_columns);
    }

    public function postAddcolumns(Request $request)
    {
        $category = Category::orderBy('created_at', 'desc')->first();

        Schema::create($category->table_name, function(Blueprint $table) use ($category, $request)
        {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            for ($i = 0; $i < $category->num_columns; $i++) {
                switch ($request->input('type' . $i)) {
                    case 0:
                        $table->integer($request->input('name' . $i));
                        break;
                    case 1:
                        $table->string($request->input('name' . $i));
                        break;
                    case 2:
                        $table->text($request->input('name' . $i));
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
