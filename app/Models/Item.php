<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'color_id',
        'user_id',
        'item_img',
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    
}
