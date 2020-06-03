<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create Administrator user with factory
        factory(User::class)->create([
            'name' => 'Club Administrator',
            'email' => 'admin@myclub.com',
            'role' => 'Administrator'
        ]);

        // create Manager user with factory
        factory(User::class)->create([
            'name' => 'Finance Manager',
            'email' => 'finance@myclub.com',
            'role' => 'Manager'
        ]);
    }
}
