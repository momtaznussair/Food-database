<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
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

    public function filter(FilterRequest $request)
    {
        $request->validated();

        $foods = Food::select();

        // filter by diets rates
        foreach ($request->diets as $diet) {
            $foods->whereHas('diets', function ($query) use ($diet, $request) {
                $query->where('id', $diet)->whereIn('rate_id', $request->diet_ratings);
            });
        }

        // filter by toxins rates
        foreach ($request->toxins as $toxin) {
            $foods->whereHas('toxins', function ($query) use ($toxin, $request) {
                $query->where('id', $toxin)->whereIn('rate_id', $request->toxin_ratings);
            });
        }

        $foods = $foods->get();

        // getting the minimum rate in (diets and toxins) filters in foods that matchs
        foreach ($foods as  $food) {
            $food['min'] = min([

                // minimum rate in diets  that match with diet filter
                $food->diets->filter(function ($diet) use ($request) {
                    return in_array($diet->id, $request->diets);
                })->pluck('pivot')->pluck('rate_id')->min(),

                // minimum rate in toxins that match with toxin filter  
                $food->toxins->filter(function ($toxin) use ($request) {
                    return in_array($toxin->id, $request->toxins);
                })->pluck('pivot')->pluck('rate_id')->min(),
            ]);
        }

        // return $foods;

        $diets = Diet::all();
        $toxins = Toxin::all();
        $rates = Rate::all();

        return view('home', ['rates' => $rates, 'diets' => $diets, 'toxins' => $toxins, 'foods' => $foods, 'old' => $request]);
    }
}
