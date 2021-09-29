<?php

namespace App\Models;

use App\Models\Diet;
use App\Models\Toxin;
use App\Models\FoodToxin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends Model
{
    use HasFactory;

    public function diets()
    {
        return $this->belongsToMany(Diet::class)->withPivot('rate_id')->withTimestamps();
    }

    public function toxins()
    {
        return $this->belongsToMany(Toxin::class)->withPivot('rate_id')->using(FoodToxin::class)
        ->withTimestamps();
    }
    
    protected $fillable = [
        'name',
    ];

    protected $table = 'foods';
}
