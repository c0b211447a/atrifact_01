<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Color;

class ColorController extends Controller
{
    //
    public function showColors(Color $select_color, Category $category)
    {
        $colors = new Color;
        return view('colors.color_element')->with(['categories' => $category->get(), 'select_color' => $select_color, 'colors' => $colors->get(), 'items' => $select_color->getItems()]);
    }
    
}