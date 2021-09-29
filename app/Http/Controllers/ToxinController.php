<?php

namespace App\Http\Controllers;

use App\Models\Toxin;
use Illuminate\Http\Request;

class ToxinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toxins = Toxin::all();
        return view('toxins.index', ['toxins' => $toxins]);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:toxins,name',
        ]);

        Toxin::create($request->all());
        return redirect('toxins')->withSuccess('Toxin Created successfully');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Toxin  $toxin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Toxin $toxin)
    {
        $request->validate([
            'name' => 'required|max:255|unique:toxins,name,'.$toxin->id,
        ]);

        $toxin->update($request->all());
        return redirect('toxins')->withSuccess('Toxin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Toxin  $toxin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Toxin $toxin)
    {
        $toxin->delete();
        return redirect('toxins')->withSuccess('Toxin deletd successfully');
    }
}
