<?php

namespace App\Http\Controllers;

use App\Models\Land;
use App\Models\Limit;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'Admin') {
            $users = User::whereNotIn('role', ['admin'])->get();
            $limit = Limit::first();
            $harvests = Product::where('owner', 'Petani')->get();
            $lands = Land::all();
            $transactions = Transaction::where('status', 'Selesai')->get();
            $orders = Order::where('status', 'Selesai')->get();

            return view("dashboard.admin", compact('users', 'limit', 'harvests', 'lands', 'transactions', 'orders'));
        } elseif (Auth::user()->role == "Petani") {
            $transactions = [];
            foreach (Auth::user()->payment as $payment) {
                $transaction = $payment->transaction;
                foreach ($payment->transaction as $tr) {
                    array_push($transactions, $tr);
                }
            }
            $products = Product::where('user_id', Auth::user()->id)->get();
            $lands = Land::where('user_id', Auth::user()->id)->get();

            return view("dashboard.petani", compact('transactions', 'products', 'lands'));
        } elseif (Auth::user()->role == 'Tengkulak') {
            $products = Product::where('user_id', Auth::user()->id)->get();
            $transactions = Transaction::where('user_id', Auth::user()->id)->get();
            $orders = Order::where('user_id', Auth::user()->id)->get();

            return view("dashboard.tengkulak", compact('products', 'transactions', 'orders'));
        } elseif (Auth::user()->role == 'Pembeli') {
            $orders = Order::where('user_id', Auth::user()->id)->get();
            return view("dashboard.pembeli", compact('orders'));
        } else {
            redirect('/login');
        }
    }

    public function profile()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request, User $user)
    {
        if (Auth::user()->role == "Tengkulak") {
            $data = $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|min:3',
                'phone' => 'required|min:3',
                'address' => 'required|min:3',
                'lattitude' => 'required|min:3',
                'longitude' => 'required|min:3',
                'image' => 'file|between:0,2048|mimes:jpeg,jpg,png|nullable',
            ]);
        } else {
            $data = $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|min:3',
                'phone' => 'required|min:3',
                'address' => 'required|min:3',
                'image' => 'file|between:0,2048|mimes:jpeg,jpg,png|nullable',
            ]);
        }
        if ($request['image']) {
            $filetype = $request->file('image')->extension();
            $text = Str::random(16) . '.' . $filetype;
            $data['image'] = Storage::putFileAs('images', $request->file('image'), $text);
        }

        $user->update($data);
        return redirect('/profiles')->with('status', 'User Diubah');
    }
}
