<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('category')->insert([
        	'cat_size' => 'One hundred million dollars',
        	'cat_r_o' => 'R'
        ]);
    }
}
