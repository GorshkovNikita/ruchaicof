<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function getIndex()
    {
        return view('home.main');
    }

    public function getAbout($type = null)
    {
        return view('home.about');
    }

    public function getProducts($type = null)
    {
        switch ($type)
        {
            case null:
                return view('home.products');
            case "tea":
                return view('products.tea');
            case "coffee":
                return view('products.coffee');
            case "china":
                return view('products.china');
            case "crystal":
                return view('products.crystal');
            case "food":
                return view('products.food');
        }
    }

    public function getOffers()
    {
        return view('home.offers');
    }

    public function getContacts()
    {
        return view('home.contacts');
    }
}
