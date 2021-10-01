<?php

namespace App\Imports;

use App\Models\Food;
use Maatwebsite\Excel\Concerns\ToModel;

class FoodsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $food =   new Food([
            'name' => $row[0],
        ]);

        $food->save();
        
        for ($i=1; $i <= 11; $i++) { 

            $food->diets()->attach([$i => ['rate_id' => $row[$i]]]);
        }

        for ($i=1; $i <= 15; $i++) { 

            $food->toxins()->attach([$i => ['rate_id' => $row[$i + 11]]]);
        }

        

        return $food;
    }
}
