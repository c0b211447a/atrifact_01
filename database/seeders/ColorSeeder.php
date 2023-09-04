<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('colors')->insert([
                'name' => '〇Blue'
        ]);
        DB::table('colors')->insert([
                'name' => '〇Blue-Green'
        ]);
        DB::table('colors')->insert([
                'name' => '〇Green'
        ]);
        DB::table('colors')->insert([
                'name' => '〇Yellow-Green'
        ]);
        DB::table('colors')->insert([
                'name' => '〇Yellow'
        ]);
        DB::table('colors')->insert([
                'name' => '〇Yellow-Orange'
        ]);
        DB::table('colors')->insert([
                'name' => '〇Orange'
        ]);
        DB::table('colors')->insert([
                'name' => '〇Red-Orange'
        ]);
        DB::table('colors')->insert([
                'name' => '〇Red'
        ]);
        DB::table('colors')->insert([
                'name' => '〇Red-Violet'
        ]);
        DB::table('colors')->insert([
                'name' => '〇Violet'
        ]);
        DB::table('colors')->insert([
                'name' => '〇Blue-Violet'
        ]);
        DB::table('colors')->insert([
                'name' => '〇Black'
        ]);
        DB::table('colors')->insert([
                'name' => '〇White'
        ]);
    }
}
