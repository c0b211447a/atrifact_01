<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('patterns.patterns')->with(['coordinations' => Auth::user()->coordinations]);
    }
    
    //選択したアイテムが含まれているパターンの一覧を表示する
    public function showItemInPatterns(Item $item_id, Coordinations $coordinations){
        // dd($item_id->coordinations()->get());
        $user_has_coordinations = [];
        $user_id = Auth::user()->id;
        foreach ($item_id->coordinations as $coordination){
            if ($coordination->user_id == $user_id){
                array_push($user_has_coordinations, $coordination);
            }
        }
        return view('patterns.item_in_patterns')->with(['coordinations' => $user_has_coordinations]);
    }
    
    public function delete_patterns(Coordinations $patterns_id){
        $patterns_id->delete();

        return redirect('/cloths/patterns');
    }
    
    public function edit_patterns(Coordinations $patterns_id, Item $item, Category $category, Color $color){
        
        $items = Auth::user()->items;
        
        //colorカテゴリに属するアイテム
        $blue=null;
        $blue_green=null;
        $green=null;
        $yellow_green=null;
        $yellow=null;
        $yellow_orange=null;
        $orange=null;
        $red_orange=null;
        $red=null;
        $red_violet=null;
        $violet=null;
        $blue_violet=null;
        $black=null;
        $gray=null;
        $white=null;
        
        $colors = [$blue,
                   $blue_green,
                   $green,
                   $yellow_green,
                   $yellow,
                   $yellow_orange,
                   $orange,
                   $red_orange,
                   $red,
                   $red_violet,
                   $violet,
                   $blue_violet,
                   $black,
                   $gray,
                   $white];
        
        for ($i=0; $i<count($colors); $i++){
            $colors[$i] = $item->where([
                                ['user_id', '=', Auth::id()],
                                ['color_id', '=', $i+1],
                                ])->get();
        };
        
        //categoryカテゴリに属するアイテム
        $accessories=null;
        $tops=null;
        $botoms=null;
        $shoes=null;
        $bags_others=null;
        
        $categories = [$accessories,
                       $tops,
                       $botoms,
                       $shoes,
                       $bags_others];
                       
        for ($i=0; $i<count($categories); $i++){
            $categories[$i] = $item->where([
                                     ['user_id', '=', Auth::id()],
                                     ['category_id', '=', $i+1],
                                     ])->get();
        }
        
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
            }
        }
        
        return view('patterns.patterns_edit')->with(['items' => $items, 
                                                    'categories' => $category->get(),
                                                    'blue' => $colors[0],
                                                    'blue_green' => $colors[1],
                                                    'green' => $colors[2],
                                                    'yellow_green' => $colors[3],
                                                    'yellow' => $colors[4],
                                                    'yellow_orange' => $colors[5],
                                                    'orange' => $colors[6],
                                                    'red_orange' => $colors[7],
                                                    'red' => $colors[8],
                                                    'red_violet' => $colors[9],
                                                    'violet' => $colors[10],
                                                    'blue_violet' => $colors[11],
                                                    'black' => $colors[12],
                                                    'gray' => $colors[13],
                                                    'white' => $colors[14],
                                                    'accessories' => $categories[0],
                                                    'tops' => $categories[1],
                                                    'botoms' => $categories[2],
                                                    'shoes' => $categories[3],
                                                    'bags_others' => $categories[4],
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
        
        $coordinations->user_id = Auth::id();
        $coordinations->save();
        $coordinations->items()->attach($item_id);
        return $coordinations;
    }
    
    //パターンを作成するための画面を表示する
    public function add_pattern(Item $item, Category $category, Color $color)
    {
        $items = Auth::user()->items;
        
        //colorカテゴリに属するアイテム
        $blue=null;
        $blue_green=null;
        $green=null;
        $yellow_green=null;
        $yellow=null;
        $yellow_orange=null;
        $orange=null;
        $red_orange=null;
        $red=null;
        $red_violet=null;
        $violet=null;
        $blue_violet=null;
        $black=null;
        $gray=null;
        $white=null;
        
        $colors = [$blue,
                   $blue_green,
                   $green,
                   $yellow_green,
                   $yellow,
                   $yellow_orange,
                   $orange,
                   $red_orange,
                   $red,
                   $red_violet,
                   $violet,
                   $blue_violet,
                   $black,
                   $gray,
                   $white];
        
        for ($i=0; $i<count($colors); $i++){
            $colors[$i] = $item->where([
                                ['user_id', '=', Auth::id()],
                                ['color_id', '=', $i+1],
                                ])->get();
        };
        
        //categoryカテゴリに属するアイテム
        $accessories=null;
        $tops=null;
        $botoms=null;
        $shoes=null;
        $bags_others=null;
        
        $categories = [$accessories,
                       $tops,
                       $botoms,
                       $shoes,
                       $bags_others];
                       
        for ($i=0; $i<count($categories); $i++){
            $categories[$i] = $item->where([
                                     ['user_id', '=', Auth::id()],
                                     ['category_id', '=', $i+1],
                                     ])->get();
        }
        
        return view('patterns.patterns_add')->with(['items' => $items, 
                                                    'categories' => $category->get(),
                                                    'blue' => $colors[0],
                                                    'blue_green' => $colors[1],
                                                    'green' => $colors[2],
                                                    'yellow_green' => $colors[3],
                                                    'yellow' => $colors[4],
                                                    'yellow_orange' => $colors[5],
                                                    'orange' => $colors[6],
                                                    'red_orange' => $colors[7],
                                                    'red' => $colors[8],
                                                    'red_violet' => $colors[9],
                                                    'violet' => $colors[10],
                                                    'blue_violet' => $colors[11],
                                                    'black' => $colors[12],
                                                    'gray' => $colors[13],
                                                    'white' => $colors[14],
                                                    'accessories' => $categories[0],
                                                    'tops' => $categories[1],
                                                    'botoms' => $categories[2],
                                                    'shoes' => $categories[3],
                                                    'bags_others' => $categories[4]
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
