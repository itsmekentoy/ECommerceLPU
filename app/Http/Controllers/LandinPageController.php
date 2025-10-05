<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemType;

class LandinPageController extends Controller
{
    public function home()
    {
        $featuredItems = Item::where('is_featured', true)->get();

        return view('homepage.home', compact('featuredItems'));
    }

    public function about()
    {
        return view('homepage.about');
    }

    public function shop()
    {
        $items = ItemType::with('items')->get();
        $itemTypes = ItemType::all();

        return view('homepage.shop', compact('items', 'itemTypes'));
    }

    public function contact()
    {
        return view('homepage.contact');
    }

    
}
