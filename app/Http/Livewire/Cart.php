<?php

namespace App\Http\Livewire;

use App\Models\Cart as ModelsCart;
use App\Models\Limit;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cart extends Component
{
    public $carts, $limit, $qty, $total;
    public function render()
    {
        if (Auth::guest()) {
            return redirect('/login');
        }
        if (Auth::user()->role == "Tengkulak") {
            $bagi = User::where('role', 'Tengkulak')->get();
            $products = Product::where(['status' => ['Tersedia', 'Kosong'], 'owner' => 'Petani'])->get();
            $limit = Limit::first();
            $total = 0;
            for ($i = 0; $i < count($products); $i++) {
                $total += $products[$i]['stok'];
            }
            $this->limit = ($total - $limit->limit) / count($bagi);
        }
        $this->carts = ModelsCart::where('user_id', Auth::user()->id)->get();
        foreach ($this->carts as $cart) {
            $this->total += $cart->product->price * $cart->quantity;
        }
        return view('livewire.cart');
    }
}
