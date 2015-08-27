<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Slug;

class ImagesController extends Controller
{
    public function getIndex()
    {
        $dir = 'images/articles';
        $dh = opendir($dir);
        $images =[];
        while (($file = readdir($dh)) !== false)
        {
            if (preg_match('/\.(jpg|png|gif)/i', $file, $matches, PREG_OFFSET_CAPTURE))
                array_push($images, $file);
        }
        closedir($dh);
        return view('admin.image.images')
            ->with('images', $images);
    }

    public function getUpload()
    {
        return view('admin.image.upload');
    }

    public function postUpload(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->messages())
                ->withInput();
        }

        $file = $request->file('image');
        $imageExtension = $file->getClientOriginalExtension();
        $imageName = Slug::make($request->input('name')) . '.' . $imageExtension;
        $request->file('image')->move(
            base_path() . '/public/images/articles/', $imageName
        );

        $msg = "Изображение \"" . $request->input('name') . "\" добавлено";
        return redirect('admin/image')
            ->with('msg', $msg);
    }

    public function postDelete($image)
    {
        unlink('images/articles/' . $image);
        $msg = "Изображение \"" . $image . "\" удалено.";
        return redirect('admin/image')
            ->with('msg', $msg);
    }

    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'image' => 'required'
        ]);
    }
}
