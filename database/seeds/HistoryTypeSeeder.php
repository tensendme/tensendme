<?php

use Illuminate\Database\Seeder;
use App\Models\Histories\HistoryType;


class HistoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HistoryType::insert([
            'name' => 'Подписка',
        ]);
        HistoryType::insert([
            'name' => 'Подписчик',
        ]);
        HistoryType::insert([
            'name' => 'Вывод баланса',
        ]);
        HistoryType::insert([
            'name' => 'Оплата',
        ]);
    }
}
