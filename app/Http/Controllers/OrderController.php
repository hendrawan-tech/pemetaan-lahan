<?php

namespace App\Http\Controllers;

use App\Models\MessageOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\TrackingDetail;
use App\Models\TrackingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == "Tengkulak") {
            $orders = [];
            foreach (Auth::user()->payment as $payment) {
                $order = $payment->order;
                foreach ($payment->order as $tr) {
                    array_push($orders, $tr);
                }
            }
            $orders;
        } else {
            $orders = Order::where('user_id', Auth::user()->id)->get();
        }
        return view('order.index', compact('orders'));
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
        $order = Order::where('id', $request->id)->first();
        $data = $request->validate([
            'image' => 'file|between:0,2048|mimes:jpeg,jpg,png',
        ]);

        $filetype = $request->file('image')->extension();
        $text = Str::random(16) . '.' . $filetype;
        $data['image'] = Storage::putFileAs('images', $request->file('image'), $text);

        $order->update(['image' => $data['image'], 'status' => 'Proses']);
        MessageOrder::create([
            'order_id' => $order->id,
            'message' => 'Pembayaran Anda Sedang Diproses',
            'status' => 'Proses'
        ]);
        return redirect('orders/' . $order->code . '');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $order = Order::where('code', $code)->first();
        return view('order.detail', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required',
            'message' => 'required',
        ]);

        $order = Order::where('id', $request->id)->first();

        $order->update(['status' => $request->status]);
        if ($request->status == 'Ditolak') {
            $product = Product::where('id', $order->item[0]['product_id'])->first();
            $product->update(['stok' => $product->stok + $order->item[0]['quantity']]);
        }
        MessageOrder::create([
            'order_id' => $order->id,
            'message' => $request->message,
            'status' => $request->status
        ]);
        $detail = TrackingDetail::where(['user_id' => Auth::user()->id, 'status' => 0])->first();
        if (!$detail) {
            $detail = TrackingDetail::where(['user_id' => Auth::user()->id])->first();
        }
        TrackingItem::create(['tracking_detail_id' => $detail->id, 'user_id' => $order->user_id]);
        $detail->update(['status' => 1]);
        return redirect('orders/' . $order->code . '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
