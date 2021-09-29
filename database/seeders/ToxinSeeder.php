<?php

namespace Database\Seeders;

use App\Models\Toxin;
use Illuminate\Database\Seeder;

class ToxinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $toxins = ['Oxalates', 'Trypsin', 'Isoflavones', 'Polyphenol', 'Saponins', 'Salicylates', 'Phytate', 'Lectins', 'Flavinoids', 'Histamine', 'Glucosinolates', 'Tannins', 'Nightshades', 'Glycemic Index', 'Glycoalkaloids'];
        foreach($toxins as $toxin)
        {
            Toxin::create([
                'name' => $toxin,
            ]);
        }
    }
}
