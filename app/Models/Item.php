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
        return $this->belongsTo(Category::class);
    }
    
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    
}
