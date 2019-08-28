<?php

use Illuminate\Database\Seeder;

class ChallengeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('challenge')->insert([
        	'text' => 'This is a challenge',
        	'value' => 1000
        ]);
    }
}
