<?php

namespace App\Models;

use App\Models\Food;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Toxin extends Model
{
    use HasFactory;


    public function foods()
    {
        return $this->belongsToMany(Food::class)->withPivot('rate_id');
    }

    protected $fillable = [
        'name',
    ];
}
