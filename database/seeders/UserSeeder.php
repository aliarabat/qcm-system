<?php

namespace Database\Seeders;

use App\Role;
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
        User::factory()
            ->count(1)
            ->for(Role::find(1))
            ->create();

        User::factory()
            ->count(2)
            ->for(Role::find(2))
            ->create();

        User::factory()
            ->count(20)
            ->for(Role::find(3))
            ->create();
    }
}
