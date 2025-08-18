@extends('frontend.layout.RootLayout')
@section('content')
    <center>
        <div class="container my-5">
            <h3>Your Shopping Cart</h3>
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($user_cart as $item)
                        <tr>
                            <td class="d-flex align-items-center">
                                <img src="{{ $item->image }}" alt="{{ $item->name }}" class="me-3" width="60" />
                                <div>
                                    <p class="mb-0">{{ $item->name }}</p>
                                </div>
                            </td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>
                                <input type="number" class="form-control" style="width: 70px;" value="{{ $item->qty }}"
                                    min="1" />
                            </td>
                            <td>${{ number_format($item->price * $item->qty, 2) }}</td>
                            <td>
                                <form action="{{ route('removeFromCart', $item->cart_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Your cart is empty.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Total:</td>
                        <td class="fw-bold">
                            ${{ number_format($user_cart->sum(fn($item) => $item->price * $item->qty), 2) }}
                        </td>
                    </tr>
                </tfoot>
            </table>

            <a href="/checkout" class="btn btn-primary float-end">Proceed to Checkout</a>
        </div>
    </center>
@endsection
