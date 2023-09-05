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
                'name' => 'Blue'
        ]);
        DB::table('colors')->insert([
                'name' => 'Blue-Green'
        ]);
        DB::table('colors')->insert([
                'name' => 'Green'
        ]);
        DB::table('colors')->insert([
                'name' => 'Yellow-Green'
        ]);
        DB::table('colors')->insert([
                'name' => 'Yellow'
        ]);
        DB::table('colors')->insert([
                'name' => 'Yellow-Orange'
        ]);
        DB::table('colors')->insert([
                'name' => 'Orange'
        ]);
        DB::table('colors')->insert([
                'name' => 'Red-Orange'
        ]);
        DB::table('colors')->insert([
                'name' => 'Red'
        ]);
        DB::table('colors')->insert([
                'name' => 'Red-Violet'
        ]);
        DB::table('colors')->insert([
                'name' => 'Violet'
        ]);
        DB::table('colors')->insert([
                'name' => 'Blue-Violet'
        ]);
        DB::table('colors')->insert([
                'name' => 'Black'
        ]);
        DB::table('colors')->insert([
                'name' => 'Gray'
        ]);
        DB::table('colors')->insert([
                'name' => 'White'
        ]);
    }
}
