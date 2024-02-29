<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cloth;
use App\Models\Item;
use App\Models\Category;
use App\Models\Color;
use App\Models\Coordinations;
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
        $img_url = Cloudinary::upload($request->file('item.new_item_img')->getRealPath())->getSecurePath();
        // dd($request);
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
        }
        
        $colors = $color->get();
        // foreach ($colors as $color_candidate)
        // {
        //     if ($item_id->color_id === $color_candidate->id)
        //     {
        //         $selected_color = $color_candidate;
        //         //選択されているカテゴリを除いた全データの取得
        //         //test
        //         //commit_test
        //         //test_3
        //         $except_id = $selected_color->id;
        //         $colors = $color->where('id', '!=', $except_id)->get();
        //         break;
        //     }
        // }
        
        return view('cloths.items_edit')->with(['item' => $item_id, 'categories' => $categories, 'selected_category' => $selected_category, 'colors' => $colors]);
        
    }
    
    //アイテムの編集を実行する
    public function update_item(Request $request, Item $item_id)
    {
        $input = $request['item'];
        // dd($request);
        $item_id->fill($input);
        //もし画像の変更があった場合は変更し、それ以外はカテゴリやカラーの情報のみを保存する
        //item.imgでブレード側のname属性値item[item_img]を表している
        if(!($request->file('item.new_item_img')===null))
        {
            $img_url = Cloudinary::upload($request->file('item.new_item_img')->getRealPath())->getSecurePath();
            $item_id->item_img = $img_url;
        }
        $item_id->save();
        return redirect('cloths/items');
    }
    
    //アイテムを削除する
    public function delete_item(Item $item_id, Coordinations $coordination)
    {
        foreach ($item_id->coordinations as $delete_coordination){
            $delete_coordination->delete();
        }
        $item_id->delete();
        return redirect('cloths/items');
    }
    
    //色の組み合わせ一覧を表示する
    public function showColors()
    {
        return view('cloths.colors');
    }
    
    
    
    // //パターンを作成するための画面を表示する
    // public function add_pattern(Item $item, Category $category, Color $color)
    // {
    //     $items = $item->get();
        
    //     //colorカテゴリに属するアイテム
    //     $blue = $item->where('color_id', '1')->get();
    //     $blue_green = $item->where('color_id', '2')->get();
    //     $green = $item->where('color_id', '3')->get();
    //     $yellow_green = $item->where('color_id', '4')->get();
    //     $yellow = $item->where('color_id', '5')->get();
    //     $yellow_orange = $item->where('color_id', '6')->get();
    //     $orange = $item->where('color_id', '7')->get();
    //     $red_orange = $item->where('color_id', '8')->get();
    //     $red = $item->where('color_id', '9')->get();
    //     $red_violet = $item->where('color_id', '10')->get();
    //     $violet = $item->where('color_id', '11')->get();
    //     $blue_violet = $item->where('color_id', '12')->get();
    //     $black = $item->where('color_id', '13')->get();
    //     $gray = $item->where('color_id', '14')->get();
    //     $white = $item->where('color_id', '15')->get();
        
    //     //categoryカテゴリに属するアイテム
    //     $accessories = $item->where('category_id', '1')->get();
    //     $tops = $item->where('category_id', '2')->get();
    //     $botoms = $item->where('category_id', '3')->get();
    //     $shoes = $item->where('category_id', '4')->get();
    //     $bags_others = $item->where('category_id', '5')->get();
        
    //     return view('patterns.patterns_add')->with(['items' => $items, 
    //                                                 'categories' => $category->get(),
    //                                                 'blue' => $blue,
    //                                                 'blue_green' => $blue_green,
    //                                                 'green' => $green,
    //                                                 'yellow_green' => $yellow_green,
    //                                                 'yellow' => $yellow,
    //                                                 'yellow_orange' => $yellow_orange,
    //                                                 'orange' => $orange,
    //                                                 'red_orange' => $red_orange,
    //                                                 'red' => $red,
    //                                                 'red_violet' => $red_violet,
    //                                                 'violet' => $violet,
    //                                                 'blue_violet' => $blue_violet,
    //                                                 'black' => $black,
    //                                                 'gray' => $gray,
    //                                                 'white' => $white,
    //                                                 'accessories' => $accessories,
    //                                                 'tops' => $tops,
    //                                                 'botoms' => $botoms,
    //                                                 'shoes' => $shoes,
    //                                                 'bags_others' => $bags_others
    //                                                 ]);
    // }
    
    
    
}
