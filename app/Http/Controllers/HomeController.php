<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ItemTransaction;
use App\Models\Land;
use App\Models\Limit;
use App\Models\MessageOrder;
use App\Models\MessageTransactions;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Tracking;
use App\Models\TrackingDetail;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
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
        $total = 0;
        $limit = Limit::first();
        $products = Product::where(['status' => ['Tersedia', 'Kosong'], 'owner' => 'Petani'])->get();
        for ($i = 0; $i < count($products); $i++) {
            $total += $products[$i]['stok'];
        }
        $product = Product::where('id', $id)->first();
        return view('detail-product', compact('product', 'total', 'limit'));
    }

    public function dataMap()
    {
        return json_encode(Land::with('product')->get());
    }

    public function dataGeo()
    {
        return json_encode(User::where('role', 'Tengkulak')->with('product')->get());
    }

    public function cart()
    {
        return view('cart');
    }

    public function addCart($id)
    {
        if (Auth::guest()) {
            return redirect('/login');
        } {
            $cart = Cart::where(['product_id' => $id, 'user_id' => Auth::user()->id])->first();

            if ($cart) {
                $cart->update(["quantity" => $cart->quantity + 1]);
            } else {
                Cart::create([
                    'product_id' => $id,
                    'quantity' => 1,
                    'user_id' => Auth::user()->id,
                ]);
            }
            return redirect('/cart');
        }
    }

    public function updateCart(Request $request)
    {
        for ($i = 0; $i < count($request->id); $i++) {
            $cart = Cart::where('id', $request->id[$i]);
            $cart->update(['quantity' => $request->quantity[$i]]);
        }
        if ($request->checkout == "true") {
            return redirect('/checkout');
        } else {
            return redirect('/cart');
        }
    }

    public function deleteCart($id)
    {
        Cart::where('id', $id)->delete();
        return redirect('/cart');
    }

    public function checkout()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $petani = [];
        for ($i = 0; $i < count($carts); $i++) {
            array_push($petani, [
                'id' => $carts[$i]->product->user_id,
                'user' => $carts[$i]->product->user,
                'payment' => $carts[$i]->product->user->payment,
            ]);
        }
        return view('checkout', compact('carts', 'petani'));
    }

    public function prosesCheckout(Request $request)
    {
        if ($request->role == 'Tengkulak') {
            $carts = Cart::where('user_id', Auth::user()->id)->get();

            foreach ($request->payment_id as $key => $payment_id) {
                $code = 'TR' . random_int(10000, 99999);
                $order = Transaction::create([
                    'code' => $code,
                    'total' => $carts[$key]->product->price * $carts[$key]->quantity,
                    'payment_id' => $payment_id,
                    'user_id' => Auth::user()->id,
                ]);
                ItemTransaction::create([
                    'product_id' => $carts[$key]->product_id,
                    'quantity' => $carts[$key]->quantity,
                    'transaction_id' => $order->id,
                ]);
                MessageTransactions::create([
                    'transaction_id' => $order->id,
                    'message' => 'Silahkan Lakukan Pembayaran Agar Pesanan Bisa Diproses'
                ]);
                $product = Product::where('id', $carts[$key]->product_id)->first();
                $product->update(['stok' => $product->stok - $carts[$key]->quantity]);
            }

            foreach ($carts as $item) {
                $item->delete();
            }

            return redirect('/transactions');
        } else {
            $carts = Cart::where('user_id', Auth::user()->id)->get();

            foreach ($request->payment_id as $key => $payment_id) {
                $code = 'TR' . random_int(10000, 99999);
                $order = Order::create([
                    'code' => $code,
                    'total' => $carts[$key]->product->price * $carts[$key]->quantity,
                    'payment_id' => $payment_id,
                    'user_id' => Auth::user()->id,
                ]);
                OrderItem::create([
                    'product_id' => $carts[$key]->product_id,
                    'quantity' => $carts[$key]->quantity,
                    'order_id' => $order->id,
                ]);
                MessageOrder::create([
                    'order_id' => $order->id,
                    'message' => 'Silahkan Lakukan Pembayaran Agar Pesanan Bisa Diproses'
                ]);
                $product = Product::where('id', $carts[$key]->product_id)->first();
                $product->update(['stok' => $product->stok - $carts[$key]->quantity]);
            }

            foreach ($carts as $item) {
                $item->delete();
            }

            return redirect('/orders');
        }
    }

    public function dataTengkulak($id)
    {
        $products = Product::where(['user_id' => $id, 'status' => 'Tersedia'])->get();
        return view('detail-tengkulak', compact('products'));
    }

    public function tracking($id)
    {
        $user = User::where('id', $id)->first();
        if ($user->role == 'Petani') {
            $trace = Tracking::where('user_id', $id)->first();
        } else {
            $trace = TrackingDetail::where('user_id', $id)->get();
        }
        return view('tracking', compact('user', 'trace'));
    }
}
