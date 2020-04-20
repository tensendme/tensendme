<?php

use Illuminate\Database\Seeder;
use \App\Models\Profiles\Role;

class RolesTableSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Quality Manager']);
    }
}
