<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cloth;

class ClothController extends Controller
{
    public function index(Post $post)
    {
        return $post->get();
    }
}
