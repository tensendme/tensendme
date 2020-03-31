<?php

use Illuminate\Database\Seeder;

class PushTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\PushNotifications\PushType::create(['name' => 'General Push']);
    }
}
