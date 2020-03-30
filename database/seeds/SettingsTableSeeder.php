<?php

use App\Models\Settings\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert([
            'about_us' => 'Test tesipsum lorem',
            'title' => 'Tensend',
            'address' => '',
            'phone' => '',
            'copyright' => '',
            'img_path' => 'tensend.png',
        ]);
    }
}
