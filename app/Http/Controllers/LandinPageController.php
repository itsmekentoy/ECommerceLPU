<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemType;

class LandinPageController extends Controller
{
    public function home()
    {
        $featuredItems = Item::where('is_featured', true)->get();

        return view('jinja.home', compact('featuredItems'));
    }

    public function about()
    {
        return view('jinja.about');
    }

    public function shop()
    {
        $items = ItemType::with('items')->get();
        $itemTypes = ItemType::all();

        return view('jinja.shop', compact('items', 'itemTypes'));
    }

    public function contact()
    {
        return view('jinja.contact');
    }

    
}
