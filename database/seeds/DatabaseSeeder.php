<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //use user seeder to create users
        $this->call(UserSeeder::class);

        //use the membership seeder to create memberships and members
        $this->call(MembershipSeeder::class);
    }
}
