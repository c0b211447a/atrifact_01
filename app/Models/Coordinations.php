<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinations extends Model
{
    use HasFactory;
    
    public function items(){
        //1つのコーディネートはたくさんのアイテムを含んでいる
        return $this->belongsToMany(Item::class)->withTimestamps();
    }
}
