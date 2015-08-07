<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Redirect;
use App\Property;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PropertiesController extends Controller
{
    public function getIndex()
    {
        $properties = Property::all();
        return view('admin.property.properties')
            ->with('properties', $properties);
    }

    public function getAdd()
    {
        return view('admin.property.add');
    }

    public function postAdd(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator->messages())
                ->withInput();
        }

        $property = new Property();

        $property->name = $request->input('name');
        $property->real_name = strtolower($request->input('real_name'));
        $property->type = $request->input('type');

        $property->save();

        $msg = "Характеристика \"" . $property->name . "\" добавлена.";

        return Redirect::to('admin/property')
            ->with('msg', $msg);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|unique:properties',
            'real_name' => 'required|unique:properties|regex:/(^[A-Za-z ]+$)+/',
            'type' => 'required|numeric'
        ]);
    }
}
