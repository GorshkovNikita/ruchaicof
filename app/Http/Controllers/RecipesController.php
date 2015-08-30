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
use DB;

class RecipesController extends Controller
{
    public function getIndex($id = null)
    {
        if ($id == null) {
            $recipes = DB::table('recipes')
                ->join('categories', 'categories.id', '=', 'recipes.category_id')
                ->select('recipes.*', 'categories.name as category_name')
                ->get();

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
            return redirect()->back()
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

    public function getEdit($id)
    {
        $recipe = Recipe::where('id', $id)->first();

        return view('admin.recipe.edit')
            ->with('recipe', $recipe);
    }

    public function postEdit(Request $request, $id)
    {
        $validator = $this->validatorForEdit($request->all(), $id);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->messages())
                ->withInput();
        }

        $recipe = Recipe::where('id', $id)->first();

        $recipe->name = $request->input('name');
        $recipe->description = $request->input('description');
        $recipe->content = $request->input('content');

        if ($request->hasFile('image')) {
            $request->file('image')->move(
                base_path() . '/public/images/recipes/' , $recipe->image
            );
        }

        $recipe->save();

        $msg = "Рецепт \"" . $recipe->name . "\" изменен.";

        return redirect('admin/recipe')
            ->with('msg', $msg);
    }

    public function postDelete(Request $request, $id)
    {
        $recipe = Recipe::where('id', $id)->first();

        if ($recipe != null) {
            $recipe->delete();
            $msg = "Рецепт \"" . $recipe->name . "\" удален.";
            return redirect('admin/recipe')
                ->with('msg', $msg);
        }
        else {
            $msg = "Рецепта с id = " . $id . " не существует.";
            return redirect('admin/recipe')
                ->with('msg', $msg);
        }
    }

    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:recipes',
            'category_id' => 'required',
            'description' => 'required|max:255',
            'content' => 'required',
            'image' => 'required'
        ]);
    }

    public function validatorForEdit(array $data, $id)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:recipes,name,'.$id,
            'description' => 'required|max:255',
            'content' => 'required'
        ]);
    }
}
