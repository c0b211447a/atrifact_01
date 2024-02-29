<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinations extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'coordinations_img',
        'tops_id',
        'tops_color_id',
        'tops_size_width',
        'tops_size_height',
        'tops_locate_x',
        'tops_locate_y',
        'botoms_id',
        'botoms_color_id',
        'botoms_size_width',
        'botoms_size_height',
        'botoms_locate_x',
        'botoms_locate_y',
        'shoes_id',
        'shoes_color_id',
        'shoes_size_width',
        'shoes_size_height',
        'shoes_locate_x',
        'shoes_locate_y',
        'others1_id',
        'others1_size_width',
        'others1_size_height',
        'others1_locate_x',
        'others1_locate_y',
        'others2_id',
        'others2_size_width',
        'others2_size_height',
        'others2_locate_x',
        'others2_locate_y'
    ];
    
    public function items(){
        //1つのコーディネートはたくさんのアイテムを含んでいる
        return $this->belongsToMany(Item::class, 'coordination_item', 'coordination_id', 'item_id');
    }
}
