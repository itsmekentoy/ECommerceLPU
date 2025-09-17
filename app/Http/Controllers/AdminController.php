<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.layout');
    }

    public function inventory()
    {
        return view('admin.product');
    }
    public function users()
    {
        return view('admin.users');
    }
    
}
