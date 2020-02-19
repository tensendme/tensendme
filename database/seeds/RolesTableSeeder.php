<?php

use Illuminate\Database\Seeder;
use \App\Models\Profiles\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            'name' => 'Super admin',
        ]);

        Role::insert([
            'name' => 'Admin',
        ]);

        Role::insert([
            'name' => 'Content-Manager',
        ]);

        Role::insert([
            'name' => 'Author',
        ]);

        Role::insert([
            'name' => 'User',
        ]);
        Role::insert([
            'name' => 'Accountant',
        ]);
    }
}
