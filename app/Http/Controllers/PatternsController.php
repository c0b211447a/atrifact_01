<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cloth;
use App\Models\Item;
use App\Models\Category;
use App\Models\Color;
use App\Models\Coordinations;
use Cloudinary;
use Illuminate\Support\Facades\DB;


class PatternsController extends Controller
{
    //作成したパターンの一覧を表示する
    public function showPatterns(Coordinations $coordinations)
    {   
        return view('patterns.patterns')->with(['coordinations' => $coordinations->get()]);
    }
    
    //選択したアイテムが含まれているパターンの一覧を表示する
    public function showItemInPatterns(Item $item_id, Coordinations $coordinations){
        // dd($item_id->coordinations()->get());
        return view('patterns.item_in_patterns')->with(['coordinations' => $item_id->coordinations]);
    }
    
    public function delete_patterns(Coordinations $patterns_id){
        // $patterns_id->items()->detach($patterns_id->id);
        // DB::table('coordination_item')->where('coordination_id', $patterns_id->id)->delete();
        $patterns_id->delete();

        return redirect('/cloths/patterns');
    }
    
    public function edit_patterns(Coordinations $patterns_id, Item $item, Category $category, Color $color){
        
        $items = $item->get();
        
        //colorカテゴリに属するアイテム
        $blue = $item->where('color_id', '1')->get();
        $blue_green = $item->where('color_id', '2')->get();
        $green = $item->where('color_id', '3')->get();
        $yellow_green = $item->where('color_id', '4')->get();
        $yellow = $item->where('color_id', '5')->get();
        $yellow_orange = $item->where('color_id', '6')->get();
        $orange = $item->where('color_id', '7')->get();
        $red_orange = $item->where('color_id', '8')->get();
        $red = $item->where('color_id', '9')->get();
        $red_violet = $item->where('color_id', '10')->get();
        $violet = $item->where('color_id', '11')->get();
        $blue_violet = $item->where('color_id', '12')->get();
        $black = $item->where('color_id', '13')->get();
        $gray = $item->where('color_id', '14')->get();
        $white = $item->where('color_id', '15')->get();
        
        //categoryカテゴリに属するアイテム
        $accessories = $item->where('category_id', '1')->get();
        $tops = $item->where('category_id', '2')->get();
        $botoms = $item->where('category_id', '3')->get();
        $shoes = $item->where('category_id', '4')->get();
        $bags_others = $item->where('category_id', '5')->get();
        
        $send_data = array();
        $tops_info = array();
        $botoms_info = array();
        $shoes_info = array();
        $others1_info = array();
        $others2_info = array();
        $others_count = 1;
        
        $tops_color = null;
        $botoms_color = null;
        $shoes_color = null;
        
        //多対多関係にあるコーディネーションとアイテムに対して行う前処理
        //紐づけられているアイテムを取り出しcoordination_itemsに追加している
        $coordination_items = array();
        foreach ($patterns_id->items as $coordination_item){
            array_push($coordination_items, $coordination_item);
        }
        
        //紐づけられているアイテムの画像に対してid,縦横サイズ,xy位置を対応付けている
        //対応付けられたものをsend_dataに追加する
        foreach ($coordination_items as $coordination_item){
            if (($coordination_item->category_id==1 || $coordination_item->category_id==5) && $others_count==1){
                $others1_info["item_img"] = $coordination_item->item_img;
                $others1_info["item_id"] = $patterns_id->others1_id;
                $others1_info["item_color_id"] = $patterns_id->others1_color_id;
                $others1_info["item_category_id"] = $coordination_item->category_id;
                $others1_info["item_locate_x"] = $patterns_id->others1_locate_x;
                $others1_info["item_locate_y"] = $patterns_id->others1_locate_y;
                $others1_info["item_size_width"] = $patterns_id->others1_size_width;
                $others1_info["item_size_height"] = $patterns_id->others1_size_height;
                $others_count += 1;
                
                
                array_push($send_data, $others1_info);
                // array_push($send_data, $others1_info);
            }
            else if ($coordination_item->category_id==2){
                $tops_info["item_img"] = $coordination_item->item_img;
                $tops_info["item_id"] = $patterns_id->tops_id;
                $tops_info["item_color_id"] = $patterns_id->tops_color_id;
                $tops_info["item_category_id"] = $coordination_item->category_id;
                $tops_info["item_locate_x"] = $patterns_id->tops_locate_x;
                $tops_info["item_locate_y"] = $patterns_id->tops_locate_y;
                $tops_info["item_size_width"] = $patterns_id->tops_size_width;
                $tops_info["item_size_height"] = $patterns_id->tops_size_height;
                
                array_push($send_data, $tops_info);
                // array_push($send_data, $tops_info);
            }
            else if ($coordination_item->category_id==3){
                $botoms_info["item_img"] = $coordination_item->item_img;
                $botoms_info["item_id"] = $patterns_id->botoms_id;
                $botoms_info["item_color_id"] = $patterns_id->botoms_color_id;
                $botoms_info["item_category_id"] = $coordination_item->category_id;
                $botoms_info["item_locate_x"] = $patterns_id->botoms_locate_x;
                $botoms_info["item_locate_y"] = $patterns_id->botoms_locate_y;
                $botoms_info["item_size_width"] = $patterns_id->botoms_size_width;
                $botoms_info["item_size_height"] = $patterns_id->botoms_size_height;
                
                array_push($send_data, $botoms_info);
                // array_push($send_data, [$coordination_item->item_img,
                //                         $patterns_id->botoms_id,
                //                         $patterns_id->botoms_color_id,
                //                         $patterns_id->botoms_locate_x,
                //                         $patterns_id->botoms_locate_y,
                //                         $patterns_id->botoms_size_width,
                //                         $patterns_id->botoms_size_height
                //                         ]);
                // array_push($send_data, $botoms_info);
            }
            else if ($coordination_item->category_id==4){
                $shoes_info["item_img"] = $coordination_item->item_img;
                $shoes_info["item_id"] = $patterns_id->shoes_id;
                $shoes_info["item_color_id"] = $patterns_id->shoes_color_id;
                $shoes_info["item_category_id"] = $coordination_item->category_id;
                $shoes_info["item_locate_x"] = $patterns_id->shoes_locate_x;
                $shoes_info["item_locate_y"] = $patterns_id->shoes_locate_y;
                $shoes_info["item_size_width"] = $patterns_id->shoes_size_width;
                $shoes_info["item_size_height"] = $patterns_id->shoes_size_height;
                
                array_push($send_data, $shoes_info);
                // array_push($send_data, $shoes_info);
            }
            else if (($coordination_item->category_id==1 || $coordination_item->category_id==5) && $others_count==2){
                $others2_info["item_img"] = $coordination_item->item_img;
                $others2_info["item_id"] = $patterns_id->others2_id;
                $others2_info["item_color_id"] = $patterns_id->others2_color_id;
                $others2_info["item_category_id"] = $coordination_item->category_id;
                $others2_info["item_locate_x"] = $patterns_id->others2_locate_x;
                $others2_info["item_locate_y"] = $patterns_id->others2_locate_y;
                $others2_info["item_size_width"] = $patterns_id->others2_size_width;
                $others2_info["item_size_height"] = $patterns_id->others2_size_height;
                
                array_push($send_data, $others2_info);
                // array_push($send_data, $others2_info);
            }
        }
        
        // dd($coordination_items,$send_data);
        
        return view('patterns.patterns_edit')->with(['items' => $items, 
                                                    'categories' => $category->get(),
                                                    'blue' => $blue,
                                                    'blue_green' => $blue_green,
                                                    'green' => $green,
                                                    'yellow_green' => $yellow_green,
                                                    'yellow' => $yellow,
                                                    'yellow_orange' => $yellow_orange,
                                                    'orange' => $orange,
                                                    'red_orange' => $red_orange,
                                                    'red' => $red,
                                                    'red_violet' => $red_violet,
                                                    'violet' => $violet,
                                                    'blue_violet' => $blue_violet,
                                                    'black' => $black,
                                                    'gray' => $gray,
                                                    'white' => $white,
                                                    'accessories' => $accessories,
                                                    'tops' => $tops,
                                                    'botoms' => $botoms,
                                                    'shoes' => $shoes,
                                                    'bags_others' => $bags_others,
                                                    'send_data' => $send_data
                                                    ]);
    }
    
    //コーディネートの保存時に呼び出される関数
    //coordinationsテーブルに保存する各種情報を受け取る
    //また各種アイテムとコーディネートの紐づけもここで行う
    //保存処理が完了したらコーディネート登録トップページへリダイレクトさせる
    public function store_pattern(Request $request, Item $item, Coordinations $coordinations)
    {
        $data = json_decode($request->getContent(), true);
        $keys = array_keys($data);
        $item_id = [];
        foreach ($keys as $key){
            if ($key=="tops"){
                $coordinations->tops_id = $data[$key]["item_id"];
                $coordinations->tops_color_id = $data[$key]["color_id"];
                $coordinations->tops_size_width = $data[$key]["size_width"];
                $coordinations->tops_size_height = $data[$key]["size_height"];
                $coordinations->tops_locate_x = $data[$key]["locate_x"];
                $coordinations->tops_locate_y = $data[$key]["locate_y"];
            } else if ($key=="botoms"){
                $coordinations->botoms_id = $data[$key]["item_id"];
                $coordinations->botoms_color_id = $data[$key]["color_id"];
                $coordinations->botoms_size_width = $data[$key]["size_width"];
                $coordinations->botoms_size_height = $data[$key]["size_height"];
                $coordinations->botoms_locate_x = $data[$key]["locate_x"];
                $coordinations->botoms_locate_y = $data[$key]["locate_y"];
            } else if ($key=="shoes"){
                $coordinations->shoes_id = $data[$key]["item_id"];
                $coordinations->shoes_color_id = $data[$key]["color_id"];
                $coordinations->shoes_size_width = $data[$key]["size_width"];
                $coordinations->shoes_size_height = $data[$key]["size_height"];
                $coordinations->shoes_locate_x = $data[$key]["locate_x"];
                $coordinations->shoes_locate_y = $data[$key]["locate_y"];
            } else if ($key=="others1"){
                $coordinations->others1_id = $data[$key]["item_id"];
                $coordinations->others1_size_width = $data[$key]["size_width"];
                $coordinations->others1_size_height = $data[$key]["size_height"];
                $coordinations->others1_locate_x = $data[$key]["locate_x"];
                $coordinations->others1_locate_y = $data[$key]["locate_y"];
            } else if ($key=="others2"){
                $coordinations->others2_id = $data[$key]["item_id"];
                $coordinations->others2_size_width = $data[$key]["size_width"];
                $coordinations->others2_size_height = $data[$key]["size_height"];
                $coordinations->others2_locate_x = $data[$key]["locate_x"];
                $coordinations->others2_locate_y = $data[$key]["locate_y"];
            } else if ($key=="coordinations_img"){
                $coordinations->coordinations_img = $data[$key];
                continue;
            } else if ($key=="user_id"){
                $coordinations->user_id = $data[$key];
                continue;
            }
            array_push($item_id, (int)($data[$key]["item_id"]));    
        }
        
        $coordinations->save();
        $coordinations->items()->attach($item_id);
        return $coordinations;
    }
    
    //パターンを作成するための画面を表示する
    public function add_pattern(Item $item, Category $category, Color $color)
    {
        $items = $item->get();
        
        //colorカテゴリに属するアイテム
        $blue = $item->where('color_id', '1')->get();
        $blue_green = $item->where('color_id', '2')->get();
        $green = $item->where('color_id', '3')->get();
        $yellow_green = $item->where('color_id', '4')->get();
        $yellow = $item->where('color_id', '5')->get();
        $yellow_orange = $item->where('color_id', '6')->get();
        $orange = $item->where('color_id', '7')->get();
        $red_orange = $item->where('color_id', '8')->get();
        $red = $item->where('color_id', '9')->get();
        $red_violet = $item->where('color_id', '10')->get();
        $violet = $item->where('color_id', '11')->get();
        $blue_violet = $item->where('color_id', '12')->get();
        $black = $item->where('color_id', '13')->get();
        $gray = $item->where('color_id', '14')->get();
        $white = $item->where('color_id', '15')->get();
        
        //categoryカテゴリに属するアイテム
        $accessories = $item->where('category_id', '1')->get();
        $tops = $item->where('category_id', '2')->get();
        $botoms = $item->where('category_id', '3')->get();
        $shoes = $item->where('category_id', '4')->get();
        $bags_others = $item->where('category_id', '5')->get();
        
        return view('patterns.patterns_add')->with(['items' => $items, 
                                                    'categories' => $category->get(),
                                                    'blue' => $blue,
                                                    'blue_green' => $blue_green,
                                                    'green' => $green,
                                                    'yellow_green' => $yellow_green,
                                                    'yellow' => $yellow,
                                                    'yellow_orange' => $yellow_orange,
                                                    'orange' => $orange,
                                                    'red_orange' => $red_orange,
                                                    'red' => $red,
                                                    'red_violet' => $red_violet,
                                                    'violet' => $violet,
                                                    'blue_violet' => $blue_violet,
                                                    'black' => $black,
                                                    'gray' => $gray,
                                                    'white' => $white,
                                                    'accessories' => $accessories,
                                                    'tops' => $tops,
                                                    'botoms' => $botoms,
                                                    'shoes' => $shoes,
                                                    'bags_others' => $bags_others
                                                    ]);
    }
    
    public function update_patterns(Request $request, Item $item, Coordinations $coordinations)
    {
        $data = json_decode($request->getContent(), true);
        $keys = array_keys($data);
        $item_id = [];
        $update_coordinate = Coordinations::find($data['id']);
        
        foreach ($keys as $key){
            if ($key=="tops"){
                $update_coordinate->tops_id = $data[$key]["item_id"];
                $update_coordinate->tops_color_id = $data[$key]["color_id"];
                $update_coordinate->tops_size_width = $data[$key]["size_width"];
                $update_coordinate->tops_size_height = $data[$key]["size_height"];
                $update_coordinate->tops_locate_x = $data[$key]["locate_x"];
                $update_coordinate->tops_locate_y = $data[$key]["locate_y"];
            } else if ($key=="botoms"){
                $update_coordinate->botoms_id = $data[$key]["item_id"];
                $update_coordinate->botoms_color_id = $data[$key]["color_id"];
                $update_coordinate->botoms_size_width = $data[$key]["size_width"];
                $update_coordinate->botoms_size_height = $data[$key]["size_height"];
                $update_coordinate->botoms_locate_x = $data[$key]["locate_x"];
                $update_coordinate->botoms_locate_y = $data[$key]["locate_y"];
            } else if ($key=="shoes"){
                $update_coordinate->shoes_id = $data[$key]["item_id"];
                $update_coordinate->shoes_color_id = $data[$key]["color_id"];
                $update_coordinate->shoes_size_width = $data[$key]["size_width"];
                $update_coordinate->shoes_size_height = $data[$key]["size_height"];
                $update_coordinate->shoes_locate_x = $data[$key]["locate_x"];
                $update_coordinate->shoes_locate_y = $data[$key]["locate_y"];
            } else if ($key=="others1"){
                $update_coordinate->others1_id = $data[$key]["item_id"];
                $update_coordinate->others1_size_width = $data[$key]["size_width"];
                $update_coordinate->others1_size_height = $data[$key]["size_height"];
                $update_coordinate->others1_locate_x = $data[$key]["locate_x"];
                $update_coordinate->others1_locate_y = $data[$key]["locate_y"];
            } else if ($key=="others2"){
                $update_coordinate->others2_id = $data[$key]["item_id"];
                $update_coordinate->others2_size_width = $data[$key]["size_width"];
                $update_coordinate->others2_size_height = $data[$key]["size_height"];
                $update_coordinate->others2_locate_x = $data[$key]["locate_x"];
                $update_coordinate->others2_locate_y = $data[$key]["locate_y"];
            } else if ($key=="coordinations_img"){
                $update_coordinate->coordinations_img = $data[$key];
                continue;
            } else if ($key=="user_id"){
                $update_coordinate->user_id = $data[$key];
                continue;
            } else if  ($key=='id'){
                continue;
            }
            array_push($item_id, (int)($data[$key]["item_id"]));    
        }
        
        $update_coordinate->save();
        $update_coordinate->items()->sync($item_id);
        return $data;
    }
}
