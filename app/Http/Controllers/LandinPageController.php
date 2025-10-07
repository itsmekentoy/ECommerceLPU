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
        $textiles = \App\Models\TextTile::with('appliedTo.category')->get();

        return view('jinja.shop', compact('items', 'itemTypes', 'textiles'));
    }

    public function contact()
    {
        return view('jinja.contact');
    }

    public function getItemsByCategory($categoryId)
    {
        $items = Item::where('item_type_id', $categoryId)
                    ->where('stock', '>', 0)
                    ->get();
        
        return response()->json(['items' => $items]);
    }
}
