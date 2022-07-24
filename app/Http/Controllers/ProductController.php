<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('user_id', Auth::user()->id)->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|min:5',
            'price' => 'required',
            'stok' => 'required',
            'description' => 'required|min:5',
            'image' => 'file|between:0,2048|mimes:jpeg,jpg,png',
        ]);

        if ($request['image']) {
            Storage::delete($product->image);
            $filetype = $request->file('image')->extension();
            $text = Str::random(16) . '.' . $filetype;
            $data['image'] = Storage::putFileAs('images', $request->file('image'), $text);
        }
        $product->update($data);
        return redirect('/products')->with('status', 'Produk Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Storage::delete($product->image);
        $product->delete();
        return redirect('/products')->with('status', 'Produk Dihapus');
    }

    public function jual($id)
    {
        $harvest = Product::where('id', $id)->first();
        $harvest->update(['status' => 'Tersedia']);
        return redirect('/products')->with('status', 'Penjualan Di Acc');
    }
}
