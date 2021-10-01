<?php

namespace App\Http\Controllers;

use App\Imports\FoodsImport;
use App\Models\Diet;
use App\Models\Food;
use App\Models\Rate;
use App\Models\Toxin;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::with(['diets', 'toxins'])->orderBy('name')->get();
        return view('foods.index', ['foods' => $foods]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $diets = Diet::all();
    //     $toxins = Toxin::all();
    //     $rates = Rate::all();
    //     return view('foods.store', ['rates' => $rates, 'diets' => $diets, 'toxins' => $toxins]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255|unique:foods,name',
    //         'diets.*' => 'exists:rates,id',
    //         'diets' => 'required|array',
    //         'toxins.*' => 'exists:rates,id',
    //         'toxins' => 'required|array',
    //     ]);

    //     $food_item = Food::create($request->all());
    //     $food_item->diets()->sync($this->mapRatings($request->diets));
    //     $food_item->toxins()->sync($this->mapRatings($request->toxins));

    //     return redirect('foods')->withSuccess('Food Item added successfully');


    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    // public function edit(Food $food)
    // {
    //     $diets = Diet::all();
    //     $toxins = Toxin::all();
    //     $rates = Rate::all();
    //     $current_diets = $food->diets->pluck('id');
    //     $current_toxins = $food->toxins->pluck('id');
    //     return view('foods.update', ['rates' => $rates, 'diets' => $diets, 'toxins' => $toxins,
    //      'food' => $food, 'current_diets' => $current_diets, 'current_toxins' => $current_toxins]);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Food  $food
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Food $food)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255|unique:foods,name,'.$food->id,
    //         'diets.*' => 'exists:rates,id',
    //         'diets' => 'required|array',
    //         'toxins.*' => 'exists:rates,id',
    //         'toxins' => 'required|array',
    //     ]);

    //     $food->update($request->all());
    //     $food->diets()->sync($this->mapRatings($request->diets));
    //     $food->toxins()->sync($this->mapRatings($request->toxins));

    //     return redirect('foods')->withSuccess('Food Item updated successfully');
    // }

    // private function mapRatings($ratings)
    // {
    //     return collect($ratings)->map(function ($rate) {
    //         return ['rate_id' => $rate];
    //     });
    // }   

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Food  $food
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Food $food)
    // {
    //     $food->diets()->detach();
    //     $food->toxins()->detach();
    //     $food->delete();

    //     return back()->withSuccess('Food Item Deleted Successfully!');
    // }

    // public function import(Request $request)
    // {
    //     Excel::import(new FoodsImport(), $request->file);
    //     return back()->withSuccess('File Imported Successfully!');
    // }

}
