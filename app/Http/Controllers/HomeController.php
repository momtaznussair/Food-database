<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use App\Models\Rate;
use App\Models\Toxin;
use Illuminate\Http\Request;

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
        return view('food', ['rates' => $rates, 'diets' => $diets, 'toxins' => $toxins]);
    }
}
