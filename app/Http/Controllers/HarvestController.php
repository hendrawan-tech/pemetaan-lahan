<?php

namespace App\Http\Controllers;

use App\Models\Land;
use App\Models\Limit;
use App\Models\PlantType;
use App\Models\Product;
use Illuminate\Http\Request;

class HarvestController extends Controller
{
    public function index()
    {
        $limit = Limit::first();
        $harvests = Product::where('owner', 'Petani')->get();
        return view('harvest.index', compact('harvests', 'limit'));
    }

    public function acc($id)
    {
        $harvest = Product::where('id', $id)->first();
        $harvest->update(['status' => 'Tersedia']);
        return redirect('/harvests')->with('status', 'Penjualan Di Acc');
    }

    public function limit()
    {
        $harvests = Product::where('owner', 'Petani')->get();
        $plants = PlantType::all();
        $limit = Limit::first();
        return view('harvest.limit', compact('harvests', 'plants', 'limit'));
    }

    public function updateLimit(Request $request)
    {
        Limit::first()->update(['limit' => $request->limit]);
        return redirect('/harvests/limit')->with('status', 'Limit Diubah');
    }

    public function reset()
    {
        $lands = Land::all();
        $products = Product::where('owner', 'Petani')->get();
        $limit = Limit::first();

        foreach ($lands as $land) {
            Land::where('id', $land->id)->first()->update(['status' => 'Proses Tanam']);
        }

        foreach ($products as $product) {
            Product::where('id', $product->id)->first()->update(['status' => 'Proses', 'stok' => '0']);
        }

        $limit->update(['limit' => '0']);

        return redirect('/harvests')->with('status', 'Reset Pertanian');
    }
}
