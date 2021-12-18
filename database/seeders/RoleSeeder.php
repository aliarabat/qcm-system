<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into roles (name) values (?)', ['MANAGER']);
        DB::insert('insert into roles (name) values (?)', ['PROFESSOR']);
        DB::insert('insert into roles (name) values (?)', ['STUDENT']);
    }
}
