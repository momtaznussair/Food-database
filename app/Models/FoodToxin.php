<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FoodToxin extends Pivot
{
    use HasFactory;

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
