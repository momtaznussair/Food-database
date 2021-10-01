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
        $toxins = ['OXALATES', 'TRYPSIN', 'ISOFLAVONES ', 'POLYPHENOLS', 'SAPONINS', 'SALICYLATES', 'PHYTATE', 'LECTINS', 'FLAVINOIDS', 'GLUCOSINOLATES', 'TANNINS', 'HISTAMINE', 'NIGHTSHADES', 'GLYCEMIC INDEX', 'GLYCOALKALOIDS'];
        foreach($toxins as $toxin)
        {
            Toxin::create([
                'name' => $toxin,
            ]);
        }
    }
}
