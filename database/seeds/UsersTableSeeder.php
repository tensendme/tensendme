<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@mail.ru',
                'password' => bcrypt('password'),
                'remember_token' => '',
                'level_id' => 1,
                'role_id' => 1,
                'city_id' => 1,
                'device_token' => 'testDevice',
                'promo_code' => '12JO3V',
                'nickname' => 'Test',
                'image_path' => 'test',
            ],
        ]);
    }
}
