<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Inserting into 
        DB::table('user')->insert([
            'f_name' => 'Mike',
            'l_name' => 'Williams',
            'cat_id' => 1,
            'c_id' => 1,
            'user_name' => 'BOI',
            'email' => 'asdf@yahoo.com',
            'password' => bcrypt('youtube'),
            'anonymous' => 'N',
            'Energy_Provider' => 'NorthWestern Energy',
            'alternative' => 'Y',
            'alt_descr' => 'I dont know what this is',
            'workplace' => 'Google',
            'user_Icon' => 'Tree?',
            'age' => 21,
            'phone_num' => '4063695235'
        ]);

        // Don't know if this works
        DB::table('user')->insert([
            'f_name' => 'Test',
            'l_name' => 'User',
            'cat_id' => 1,
            'c_id' => 1,
            'user_name' => 'testuser',
            'email' => 'testuser@gmail.com',
            'password' => bcrypt('testuser'),
            'anonymous' => 'Y',
            'Energy_Provider' => 'North Western Energy',
            'alternative' => 'N',
            'alt_descr' => 'none',
            'workplace' => 'test workplace',
            'user_Icon' => 'Something',
            'age' => 99,
            'phone_num' => '123456789'
        ]);

        // Don't know if this works 2
        DB::table('user')->insert([
            'f_name' => 'Test2',
            'l_name' => 'User2',
            'cat_id' => 1,
            'c_id' => 1,
            'user_name' => 'testuser2',
            'email' => 'testuser2@gmail.com',
            'password' => bcrypt('testuser2'),
            'anonymous' => 'Y',
            'Energy_Provider' => 'North Western Energy',
            'alternative' => 'N',
            'alt_descr' => 'none',
            'workplace' => 'test workplace',
            'user_Icon' => 'Something',
            'age' => 18,
            'phone_num' => '987654321'
        ]);
    }
}
