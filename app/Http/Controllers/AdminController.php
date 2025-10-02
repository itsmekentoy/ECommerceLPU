<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerInformation;
use App\Models\Item;

class AdminController extends Controller
{
    public function index()
    {


        return view('admin.layout');
    }

    
    public function users()
    {
        return view('admin.users');
    }
    
}
