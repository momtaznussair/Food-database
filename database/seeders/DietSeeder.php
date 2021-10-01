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
        $diets = ['AIP', 'GAPS', 'WAHLS', 'WHOLE30', 'FODMAP', 'GLUTEN FREE', 'CASEIN FREE', 'SCD', 'FAILSAFE (RPAH DIET)', 'HISTAMINE FREE', 'KETO'];
        foreach($diets as $diet)
        {
            Diet::create([
                'name' => $diet,
            ]);
        }
    }
}
