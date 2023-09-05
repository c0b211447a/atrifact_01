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
                'name' => 'Accessories'
        ]);
         DB::table('categories')->insert([
                'name' => 'Tops'
        ]);
         DB::table('categories')->insert([
                'name' => 'Botoms'
        ]);
         DB::table('categories')->insert([
                'name' => 'Shoes'
        ]);
         DB::table('categories')->insert([
                'name' => 'Bags/others'
        ]);
        
    }
}
