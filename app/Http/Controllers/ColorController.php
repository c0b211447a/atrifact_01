<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Category;
use App\Models\Color;

class ColorController extends Controller
{
    //
    public function showColors(Color $select_color, Category $category)
    {
        $colors = new Color;
        $items = $select_color->getItems();
        $user_id = Auth::user()->id;
        $has_items = [];
        foreach ($items as $item){
            if ($item->user_id == $user_id){
                array_push($has_items, $item);
            }
        }
        return view('colors.color_element')->with(['categories' => $category->get(), 'select_color' => $select_color, 'colors' => $colors->get(), 'items' => $has_items]);
    }
    
}