<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'category_id',
        'color_id',
        'user_id',
        'item_img',
    ];
    
    public function category()
    {
        //一つのアイテムは一つのカテゴリをもつ
        return $this->belongsTo(Category::class);
    }
    
    public function color()
    {
        //一つのアイテムは一つのカラーをもつ
        return $this->belongsTo(Color::class);
    }
    
    public function coordinations()
    {
        //一つのアイテムはたくさんのコーディネートの一部になっている
        return $this->belongsToMany(Coordinations::class)->withTimestamps();
    }
    
    //カテゴリに登録されているアイテムをとってくる
    public function getCategory()
    {
        return $this->category()->with('items')->get();
    }
    
    //カラーに登録されているアイテムをとってくる
    public function getColor()
    {
        return $this->color()->with('items')->get();
    }
}

