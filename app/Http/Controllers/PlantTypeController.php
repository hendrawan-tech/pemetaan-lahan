<?php

namespace App\Http\Controllers;

use App\Models\PlantType;
use Illuminate\Http\Request;

class PlantTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plants = PlantType::all();
        return view('plant.index', compact('plants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PlantType::create($request->validate([
            'name' => 'required|min:3'
        ]));

        return redirect('/plants')->with('status', 'Jenis Tanaman Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlantType  $plantType
     * @return \Illuminate\Http\Response
     */
    public function show(PlantType $plant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlantType  $plantType
     * @return \Illuminate\Http\Response
     */
    public function edit(PlantType $plant)
    {
        return view('plant.edit', compact('plant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlantType  $plantType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlantType $plant)
    {
        $plant->update($request->validate([
            'name' => 'required|min:3'
        ]));

        return redirect('/plants')->with('status', 'Jenis Tanaman Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlantType  $plantType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlantType $plant)
    {
        $plant->delete();

        return redirect('/plants')->with('status', 'Jenis Tanaman Dihapus');
    }
}
