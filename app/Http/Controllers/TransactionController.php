<?php

namespace App\Http\Controllers;

use App\Models\MessageTransactions;
use App\Models\Product;
use App\Models\Tracking;
use App\Models\TrackingDetail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == "Petani") {
            $transactions = [];
            foreach (Auth::user()->payment as $payment) {
                $transaction = $payment->transaction;
                foreach ($payment->transaction as $tr) {
                    array_push($transactions, $tr);
                }
            }
            $transactions;
        } else {
            $transactions = Transaction::where('user_id', Auth::user()->id)->get();
        }
        return view('transaction.index', compact('transactions'));
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
        $transaction = Transaction::where('id', $request->id)->first();
        $data = $request->validate([
            'image' => 'file|between:0,2048|mimes:jpeg,jpg,png',
        ]);

        $filetype = $request->file('image')->extension();
        $text = Str::random(16) . '.' . $filetype;
        $data['image'] = Storage::putFileAs('images', $request->file('image'), $text);

        $transaction->update(['image' => $data['image'], 'status' => 'Proses']);
        MessageTransactions::create([
            'transaction_id' => $transaction->id,
            'message' => 'Pembayaran Anda Sedang Diproses',
            'status' => 'Proses'
        ]);
        return redirect('transactions/' . $transaction->code . '');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $transaction = Transaction::where('code', $code)->first();
        return view('transaction.detail', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'message' => 'required',
        ]);

        $transaction = Transaction::where('id', $request->id)->first();

        $transaction->update(['status' => $request->status]);
        if ($request->status == 'Ditolak') {
            $product = Product::where('id', $transaction->item[0]['product_id'])->first();
            $product->update(['stok' => $product->stok + $transaction->item[0]['quantity']]);
        }
        MessageTransactions::create([
            'transaction_id' => $transaction->id,
            'message' => $request->message,
            'status' => $request->status
        ]);
        $product = Product::where('id', $transaction->item[0]['product_id'])->first();
        Product::create([
            'name' => $product['name'],
            'stok' => $transaction->item[0]['quantity'],
            'price' => '0',
            'description' => '',
            'image' => $product['image'],
            'status' => 'Proses',
            'owner' => 'Tengkulak',
            'plant_type_id' => $product['plant_type_id'],
            'land_id' => $product['land_id'],
            'user_id' => $transaction->user_id,
        ]);
        $tracking = Tracking::create(['user_id' => Auth::user()->id]);
        TrackingDetail::create(['tracking_id' => $tracking->id, 'user_id' => $transaction->user_id]);
        return redirect('transactions/' . $transaction->code . '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
