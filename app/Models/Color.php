<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
    //カラーに属しているアイテムをとってくる
    //この時対象となるカラーカテゴリは暗黙の結合によって
    //自動的に絞られている
    public function getItems()
    {
        return $this->items()->with('color')->get();
    }
}
