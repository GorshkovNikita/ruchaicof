<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Offer;
use Slug;

class OffersController extends Controller
{
    public function getIndex()
    {
        $offers = Offer::all();
        return view('admin.offer.offers')
            ->with('offers', $offers);
    }

    public function getAdd()
    {
        return view('admin.offer.add');
    }

    public function postAdd(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->messages())
                ->withInput();
        }

        $offer = new Offer();

        $offer->title = $request->input('title');
        $offer->description = $request->input('description');
        $offer->content = $request->input('content');

        $file = $request->file('image');
        $imageExtension = $file->getClientOriginalExtension();
        $imageName = Slug::make($offer->title) . '.' . $imageExtension;
        $request->file('image')->move(
            base_path() . '/public/images/offers/', $imageName
        );

        $offer->image = $imageName;

        $offer->save();

        $msg = "Новость \"" . $offer->title . "\" добавлена.";

        return redirect('admin/offer')
            ->with('msg', $msg);
    }

    public function getEdit($id)
    {
        $offer = Offer::where('id', $id)->first();

        return view('admin.offer.edit')
            ->with('offer', $offer);
    }

    public function postEdit(Request $request, $id)
    {
        $validator = $this->validatorForEdit($request->all(), $id);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->messages())
                ->withInput();
        }

        $offer = Offer::where('id', $id)->first();

        $offer->title = $request->input('title');
        $offer->description = $request->input('description');
        $offer->content = $request->input('content');

        if ($request->hasFile('image')) {
            $request->file('image')->move(
                base_path() . '/public/images/offers/' , $offer->image
            );
        }

        $offer->save();

        $msg = "Предложение \"" . $offer->title . "\" изменено.";

        return redirect('admin/offer')
            ->with('msg', $msg);
    }

    public function postDelete(Request $request, $id)
    {
        $offer = Offer::where('id', $id)->first();

        if ($offer != null) {
            $offer->delete();
            $msg = "Предложение \"" . $offer->title . "\" удалено.";
            return redirect('admin/offer')
                ->with('msg', $msg);
        }
        else {
            $msg = "Предложения с id = " . $id . " не существует.";
            return redirect('admin/offer')
                ->with('msg', $msg);
        }
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
