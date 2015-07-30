<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $categories = Category::all();
        return view('admin.category.categories')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
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

        $file = $request->file('image');
        $imageName = $file->getClientOriginalName();

        $request->file('image')->move(
            base_path() . '/public/images/', $imageName
        );

        $category->image = 'images/' . $imageName;

        $category->save();

        return "Продукт добавлен!";

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
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
