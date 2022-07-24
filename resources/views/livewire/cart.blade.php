<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Keranjang</h6>
                    @if (Auth::user()->role == 'Tengkulak')
                        <h6 class="m-0 font-weight-bold">Limit Pembelian Anda : {{ $limit }}
                        </h6>
                    @endif
                </div>
                <div class="card-body">
                    <form action="cart" method="POST" id="edit">
                        @csrf
                        <input type="hidden" name="checkout" id="checkout" value="false">
                        <input type="hidden" name="role" id="role" value="{{ Auth::user()->role }}">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga/kilo</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($carts as $item)
                                        <input type="hidden" name="id[]" value="{{ $item->id }}">
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ Helper::price($item->product->price) }}</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="input-group mb-3 w-50">
                                                        <input type="number" name="quantity[]" min="1"
                                                            class="form-control"
                                                            max="{{ Auth::user()->role == 'Tengkulak' ? $limit / count($carts) : $item->product->stok }}"
                                                            value="{{ $item->quantity }}" required>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ Helper::price($item->product->price * $item->quantity) }}
                                            </td>
                                            <td class="text-center">
                                                <a href="/delete-cart/{{ $item->id }}"
                                                    class="btn btn-sm btn-danger btn-circle">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Keranjang Kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <h3 class="text-right">Total Harga : {{ Helper::price($total) }}</h3>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-success mr-3" type="submit">
                                Update Keranjang
                            </button>
                            <button javascript:{}"
                                onclick="document.getElementById('checkout').setAttribute('value', 'true');"
                                class="btn
                                btn-primary" type="submit">
                                Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
