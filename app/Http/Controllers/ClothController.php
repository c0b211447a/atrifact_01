<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cloth;
use App\Models\Item;
use App\Models\Category;
use App\Models\Color;
use Cloudinary;

class ClothController extends Controller
{   
    //トップページを表示する
    public function index(Cloth $cloth)
    {
        return view('cloths.index')->with(['cloths' => $cloth->get()]);
    }
    
    //アイテム一覧を表示する
    public function showItems(Item $item, Category $category, Color $color)
    {
        return view('cloths.items')->with(['items' => $item->get(), 'categories' => $category->get(), 'colors' => $color->get()]);
    }
    
    //アイテム登録画面に移動する
    public function add_items(Category $category, Color $color)
    {
        return view('cloths.items_add')->with(['categories' => $category->get(), 'colors' => $color->get()]);
    }
    
    //アイテムを保存する
    public function store_items(Request $request, Item $item)
    {
        $input = $request['item'];
        $img_url = Cloudinary::upload($request->file('item.item_img')->getRealPath())->getSecurePath();
        $input += ['item_img' => $img_url];
        $item->fill($input)->save();
        return redirect('cloths/items');
    }
    
    //色の組み合わせ一覧を表示する
    public function showColors()
    {
        return view('cloths.colors');
    }
    
    //作成したパターンの一覧を表示する
    public function showPatterns()
    {
        return view('cloths.patterns');
    }
    
}
