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
        return view('admin.inventory');
    }
    public function addProduct()
    {
        return view('admin.add-product');
    }
    public function addProductType()
    {
        return view('admin.add-product-type');
    }
}
