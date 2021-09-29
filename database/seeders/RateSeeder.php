<?php

namespace Database\Seeders;

use App\Models\Rate;
use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rates = ['Avoid', 'Moderate', 'Uncertain', 'Safe'];
        foreach($rates as $rate)
        {
            Rate::create([
                'name' => $rate,
            ]);
        }
    }
}
