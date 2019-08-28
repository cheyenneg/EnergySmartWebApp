<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        /*
        seeding for use in testing the login controller functionality ONLY
        */
        //$this->call(CategoryTableSeeder::class);
        //$this->call(ChallengeTableSeeder::class);
        //$this->call(UserTableSeeder::class);
    }
}
