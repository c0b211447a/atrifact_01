<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class CategoryController extends Controller
{
    //５個のブレードファイルを一つのブレードファイルにすることができた
    /*public function showCategories(Category $select_category)
    {
        if ($select_category->id === 1)
        {
            $blade_name = "category_accessories";
        }
        else if ($select_category->id === 2)
        {
            $blade_name = "category_tops";
        }
        else if ($select_category->id === 3)
        {
            $blade_name = "category_botoms";
        }
        else if ($select_category->id === 4)
        {
            $blade_name = "category_shoes";
        }
        else if ($select_category->id === 5)
        {
            $blade_name ="category_bags_others";
        }
        
        return view('categories.'.$blade_name)->with(['select_category' => $select_category, 'items' => $select_category->getItems()]);
    }
    */
    
    //暗黙の結合によって今選択されているカテゴリーは自動的に$select_categoryに入っている
    //またリレーションを使うことでそのカテゴリーに属するアイテムをitemsに入れることができている
    public function showCategories(Category $select_category)
    {
        return view('categories.category_element')->with(['select_category' => $select_category, 'items' => $select_category->getItems()]);
    }
}
