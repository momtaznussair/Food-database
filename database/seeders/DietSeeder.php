<?php

namespace Database\Seeders;

use App\Models\Diet;
use Illuminate\Database\Seeder;

class DietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diets = ['AIP', 'GAPS', 'Wahls', 'Whole30', 'Gluten Free', 'Casein Free', 'SCD', 'FailSafe', 'Histamine Free', 'Keto'];
        foreach($diets as $diet)
        {
            Diet::create([
                'name' => $diet,
            ]);
        }
    }
}
