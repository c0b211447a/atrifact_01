<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
                'name' => '〇Accessories'
        ]);
         DB::table('categories')->insert([
                'name' => '〇Tops'
        ]);
         DB::table('categories')->insert([
                'name' => '〇Botoms'
        ]);
         DB::table('categories')->insert([
                'name' => '〇Shoes'
        ]);
         DB::table('categories')->insert([
                'name' => '〇Bags/others'
        ]);
        
    }
}
