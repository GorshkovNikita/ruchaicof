<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\News;
use Slug;

class NewsController extends Controller
{
    public function getIndex()
    {
        $news = News::all();
        return view('admin.news.news')
            ->with('news', $news);
    }

    public function getAdd()
    {
        return view('admin.news.add');
    }

    public function postAdd(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->messages())
                ->withInput();
        }

        $item = new News();

        $item->title = $request->input('title');
        $item->description = $request->input('description');
        $item->content = $request->input('content');

        $file = $request->file('image');
        $imageExtension = $file->getClientOriginalExtension();
        $imageName = Slug::make($item->title) . '.' . $imageExtension;
        $request->file('image')->move(
            base_path() . '/public/images/news/', $imageName
        );

        $item->image = $imageName;

        $item->save();

        $msg = "Новость \"" . $item->title . "\" добавлена.";

        return redirect('admin/news')
            ->with('msg', $msg);
    }

    public function getEdit($id)
    {

    }

    public function postEdit(Request $request, $id)
    {

    }

    public function postDelete(Request $request, $id)
    {

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|max:255|unique:news',
            'description' => 'required|max:255',
            'content' => 'required',
            'image' => 'required'
        ]);
    }

    protected function validatorForEdit(array $data, $id)
    {
        return Validator::make($data, [
            'title' => 'required|max:255|unique:news,title,'.$id,
            'description' => 'required|max:255',
            'content' => 'required'
        ]);
    }
}
