<?php

use App\Membership;
use App\Member;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create companies with factory
        factory(Membership::class, 10)->create()->each(function ($membership) {

            //let's create 10 employees for each company
            for($i = 0; $i < 10; $i++) {
                $membership->members()->save(factory(Member::class)->make());
            }
        });
    }
}
