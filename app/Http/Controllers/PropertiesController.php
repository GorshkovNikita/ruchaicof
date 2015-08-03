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
        $request->session()->flash('msg', $msg);

        return Redirect::to('admin/property');
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
    public function getEdit($id)
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
            'real_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
            'type' => 'required|numeric'
        ]);
    }
}
