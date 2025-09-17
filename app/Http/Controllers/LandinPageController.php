<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandinPageController extends Controller
{
    public function home()
    {
        return view('jinja.home');
    }
    public function about()
    {
        return view('jinja.about');
    }
    public function shop()
    {
        return view('jinja.shop');
    }
    public function contact()
    {
        return view('jinja.contact');
    }
}
