<?php

use Illuminate\Database\Seeder;

class SubscriptionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Subscriptions\SubscriptionType::insert([
            'name' => 'Начальная бесплатная подписка',
            'price' => 0,
            'expired_at' => 7
        ]);
    }
}
