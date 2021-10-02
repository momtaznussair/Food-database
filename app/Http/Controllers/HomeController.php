<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use App\Models\DietFood;
use App\Models\Food;
use App\Models\FoodToxin;
use App\Models\Rate;
use App\Models\Toxin;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $diets = Diet::all();
        $toxins = Toxin::all();
        $rates = Rate::all();
        $foods = Food::orderBy('name')->with('diets', 'toxins')->get();
        return view('home', ['rates' => $rates, 'diets' => $diets, 'toxins' => $toxins, 'foods' => $foods]);
    }

    /**
     * filter a list of food.
     *
     * @return \Illuminate\Http\Response
     */

    public function filter(Request $request)
    {
        $request->validate([
            'diet_ratings.*' => 'exists:rates,id',
            'diet_ratings' => 'required|array|min:1',
            'toxin_ratings.*' => 'exists:rates,id',
            'toxin_ratings' => 'required|array|min:1',
            'diets.*' => 'exists:diets,id',
            'diets' => 'required|array|min:1',
            'toxins.*' => 'exists:toxins,id',
            'toxins' => 'required|array|min:1',
        ]);

        

        // filter by diets rates
        $filtered_foods = [];
        foreach ($request->diet_ratings as $rate) {
            $foods = Food::select();
            foreach ($request->diets as $diet) {

            $foods->whereHas('diets', function ($query) use($diet, $request, $rate) {
                $query->where('id', $diet)->where('rate_id', $rate);
            });
            }
            $filtered_foods[] = $foods->get();
        }

        $filtered_by_diets = Arr::collapse($filtered_foods);

       // filter by toxins rates
       $filtered_foods = [];
       foreach ($request->toxin_ratings as $rate) {
           $foods = Food::select();
           foreach ($request->toxins as $toxin) {

           $foods->whereHas('toxins', function ($query) use($toxin, $request, $rate) {
               $query->where('id', $toxin)->where('rate_id', $rate);
           });
           }
           $filtered_foods[] = $foods->get();
       }

        $filtered_by_toxins = Arr::collapse($filtered_foods);

        // getting the food items that satisfy the diet filters and the toxins filters
        $foods = collect($filtered_by_diets)->intersect($filtered_by_toxins);
        
        // getting the minimum rate in (diets and toxins) filters in foods that matchs
        foreach ($foods as  $food) {
            $food['min'] = min([

                // minimum rate in diets  that match with diet filter
                $food->diets->filter(function ($diet) use($request) {
                    return in_array($diet->id, $request->diets);
                })->pluck('pivot')->pluck('rate_id')->min(),

                // minimum rate in toxins that match with toxin filter  
                $food->toxins->filter(function ($toxin) use($request){
                    return in_array($toxin->id, $request->toxins);
                })->pluck('pivot')->pluck('rate_id')->min(),
            ]);
        }

        $diets = Diet::all();
        $toxins = Toxin::all();
        $rates = Rate::all();

        return view('home', ['rates' => $rates, 'diets' => $diets, 'toxins' => $toxins, 'foods' => $foods, 'old' => $request]);
    }
}
