<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use Validator;
use Redirect;
use App\Recipe;
use Slug;

class RecipesController extends Controller
{
    public function getIndex($id = null)
    {
        if ($id == null) {
            $recipes = Recipe::all();
            return view('admin.recipe.recipes')
                ->with('recipes', $recipes);
        }
        else {
            $recipe = Recipe::find($id);
            return view('admin.recipe.recipe')
                ->with('recipe', $recipe);
        }
    }

    public function getAdd()
    {
        $categories = Category::where('final', 1)->where('type', 1)->get();
        return view('admin.recipe.add')
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

        $recipe = new Recipe();

        $recipe->name = $request->input('name');
        $recipe->category_id = $request->input('category_id');
        $recipe->description = $request->input('description');
        $recipe->content = $request->input('content');

        $file = $request->file('image');
        $imageExtension = $file->getClientOriginalExtension();
        $imageName = Slug::make($recipe->name) . '.' . $imageExtension;
        $request->file('image')->move(
            base_path() . '/public/images/recipes/', $imageName
        );

        $recipe->image = $imageName;

        $recipe->save();

        $msg = "Рецепт \"" . $recipe->name . "\" добавлен.";

        return redirect('admin/recipe')
            ->with('msg', $msg);
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

    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'category_id' => 'required',
            'description' => 'required|max:255',
            'content' => 'required',
            'image' => 'required'
        ]);
    }
}
