<?php

use Illuminate\Database\Seeder;
use \App\Models\Meditations\AudioLanguage;

class AudioLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            AudioLanguage::insert([
                'name' => 'Русский',
            ]);

            AudioLanguage::insert([
                'name' => 'Казахский',
            ]);
        }
    }
}
