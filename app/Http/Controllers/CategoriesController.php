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
        $validator = $this->validatorForAdd($request->all());

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

        $category->image = $imageName;

        if ($category->final == 0) {
            $category->save();
            $msg = "Категория \"" . $category->name . "\" добавлена.";
            return redirect('admin/category')
                ->with('msg', $msg);
        }
        else {
            $request->session()->flash('category', $category);
            return redirect('admin/category/addcolumns');
        }

    }

    public function getAddcolumns(Request $request)
    {
        $category = session('category');
        $request->session()->flash('category', $category);
        $properties = Property::all();

        return view('admin.category.add_columns')
            ->with('num', $category->num_columns)
            ->with('properties', $properties);
    }

    public function postAddcolumns(Request $request)
    {
        $category = session('category');
        $category->save();

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
                    case 3:
                        $table->date($property->real_name);
                }
            }
            $table->timestamps();
        });

        Schema::table($category->table_name, function(Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('Products');
        });

        $msg = "Категория \"" . $category->name . "\" добавлена.";

        return redirect('admin/category')
            ->with('msg', $msg);
    }

    public function getEdit($id = null)
    {
        $category = Category::find($id);

        if ($category != null)
            return view('admin.category.edit')->with('category', $category);
        else
            // TODO: исправить это на вывод сообщения о том, что категории не существует, если будет необходимо
            return redirect('admin/category');
    }

    public function postEdit(Request $request, $id) {
        $validator = $this->validatorForEdit($request->all());

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator->messages())
                ->withInput();
        }

        $category = Category::find($id);

        $category->name = $request->input('name');
        $category->table_name = $request->input('table_name');
        $category->description = $request->input('description');

        if ($request->hasFile('image')) {
            $request->file('image')->move(
                base_path() . '/public/images/categories/' , $category->image
            );
        }

        $category->save();

        $msg = "Категория \"" . $category->name . "\" изменена.";

        return redirect('admin/category')
            ->with('msg', $msg);
    }

    public function postDelete(Request $request, $id)
    {
        $category = Category::find($id);

        if ($category != null) {
            // TODO: когда в таблице продуктов появятся записи, продумать удаление этих записей
            if ($category->final == 1)
                Schema::drop($category->table_name);
            $msg = "Категория \"" . $category->name . "\" удалена.";
            $category->delete();
            return redirect('admin/category')
                ->with('msg', $msg);
        }
        else {
            $msg = "Категории с id = " . $id . " не существует.";
            return redirect('admin/category')
                ->with('msg', $msg);
        }
    }

    protected function validatorForAdd(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:categories',
            'table_name' => 'required|max:255|unique:categories|regex:/(^[A-Za-z ]+$)+/',
            'description' => 'required',
            'image' => 'required'
        ]);
    }

    protected function validatorForEdit(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:categories',
            'table_name' => 'required|max:255|unique:categories|regex:/(^[A-Za-z ]+$)+/',
            'description' => 'required'
        ]);
    }

    protected function validatorForAddColumns(array $data)
    {
        return Validator::make($data, [
            // TODO: написать валидатор для добавления колонок - значения должны быть различны
        ]);
    }
}
