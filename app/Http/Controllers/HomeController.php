<?php

namespace App\Http\Controllers;

use App\Models\Land;
use App\Models\Limit;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $products = [];
        if (Auth::guest()) {
            $products = Product::where(['status' => ['Tersedia', 'Kosong'], 'owner' => 'Tengkulak'])->get();
        } else {
            if (Auth::user()->role == "Tengkulak") {
                $products = Product::where(['status' => ['Tersedia', 'Kosong'], 'owner' => 'Petani'])->get();
            }
        }
        $total = 0;
        $limit = Limit::first();
        for ($i = 0; $i < count($products); $i++) {
            $total += $products[$i]['stok'];
        }
        return view('welcome', compact('products', 'total', 'limit'));
    }

    public function detailProduct($id)
    {
        $product = Product::where('id', $id)->first();
        return view('detail-product', compact('product'));
    }

    public function dataMap()
    {
        return json_encode(Land::with('product')->get());
    }
}
