<?php

use App\Models\Profiles\Level;
use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::insert([
            'name' => 'Start Level',
            'start_count' => 0,
            'end_count' => 10,
            'discount_percentage' => 10,
            'period_date' => '300'
        ]);
    }
}
