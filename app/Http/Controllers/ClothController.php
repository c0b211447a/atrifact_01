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
    public function add_item(Category $category, Color $color)
    {
        return view('cloths.items_add')->with(['categories' => $category->get(), 'colors' => $color->get()]);
    }
    
    //アイテムを保存する
    public function store_item(Request $request, Item $item)
    {
        $input = $request['item'];
        $img_url = Cloudinary::upload($request->file('item.item_img')->getRealPath())->getSecurePath();
        $item->fill($input);
        $item->item_img = $img_url;
        $item->save();
        return redirect('cloths/items');
    }
    
    //アイテムを編集画面を表示する
    public function edit_item(Item $item_id, Category $category, Color $color)
    {
        //今選択されているカテゴリを探すための処理.
        $categories = $category->get();
        foreach ($categories as $category_candidate)
        {
            if ($item_id->category_id === $category_candidate->id)
            {
                $selected_category = $category_candidate;
                //選択されているカテゴリを除いた全データの取得
                $except_id = $selected_category->id;
                $categories = $category->where('id', '!=', $except_id)->get();
                break;
            }
            $sadfja = 1234545;
        }
        
        $colors = $color->get();
        foreach ($colors as $color_candidate)
        {
            if ($item_id->color_id === $color_candidate->id)
            {
                $selected_color = $color_candidate;
                //選択されているカテゴリを除いた全データの取得
                //test
                //commit_test
                //test_3
                $except_id = $selected_color->id;
                $colors = $color->where('id', '!=', $except_id)->get();
                break;
            }
        }
        
        return view('cloths.items_edit')->with(['item' => $item_id, 'categories' => $categories, 'selected_category' => $selected_category, 'colors' => $colors, 'selected_color' => $selected_color]);
        
    }
    
    //アイテムの編集を実行する
    public function update_item(Request $request, Item $item_id)
    {
        $input = $request['item'];
        $item_id->fill($input);
        //もし画像の変更があった場合は変更し、それ以外はカテゴリやカラーの情報のみを保存する
        //item.imgでブレード側のname属性値item[item_img]を表している
        if(!($request->file('item.item_img')===null))
        {
            $img_url = Cloudinary::upload($request->file('item.item_img')->getRealPath())->getSecurePath();
            $item_id->item_img = $img_url;
        }
        $item_id->save();
        return redirect('cloths/items');
    }
    
    //アイテムを削除する
    public function delete_item(Item $item_id)
    {
        $item_id->delete();
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
