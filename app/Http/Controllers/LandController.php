<?php

namespace App\Http\Controllers;

use App\Models\Land;
use App\Models\PlantType;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lands = Land::where('user_id', Auth::user()->id)->get();
        return view('land.index', compact('lands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plants = PlantType::all();
        return view('land.create', compact('plants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'lattitude' => 'required|min:3',
            'longitude' => 'required|min:3',
            'plant_type_id' => 'required',
        ]);
        $data['user_id'] = Auth::user()->id;
        Land::create($data);
        return redirect('/lands')->with('status', 'Lahan Ditambah');
    }

    public function panen(Land $land)
    {
        return view('land.panen', compact('land'));
    }

    public function formPanen(Request $request, Land $land)
    {
        $data = $request->validate([
            'name' => 'required|min:5',
            'price' => 'required',
            'stok' => 'required',
            'description' => 'required|min:5',
            'image' => 'file|between:0,2048|mimes:jpeg,jpg,png',
        ]);

        $data['plant_type_id'] = $land->plant_type_id;
        $data['land_id'] = $land->id;
        $data['user_id'] = Auth::user()->id;

        $filetype = $request->file('image')->extension();
        $text = Str::random(16) . '.' . $filetype;
        $data['image'] = Storage::putFileAs('images', $request->file('image'), $text);

        Product::create($data);
        $land->update(['status' => 'Sudah Panen']);
        return redirect('/products')->with('status', 'Lahan Dipanen');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function show(Land $land)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function edit(Land $land)
    {
        $plants = PlantType::all();
        return view('land.edit', compact('land', 'plants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Land $land)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'lattitude' => 'required|min:3',
            'longitude' => 'required|min:3',
            'plant_type_id' => 'required',
        ]);
        $land->update($data);
        return redirect('/lands')->with('status', 'Lahan Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function destroy(Land $land)
    {
        $land->delete();
        return redirect('/lands')->with('status', 'Lahan Dihapus');
    }
}
