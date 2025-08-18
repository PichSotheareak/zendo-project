@extends('frontend.layout.RootLayout')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4 text-center">🧾 Checkout</h2>
        <div class="row">
            <!-- Billing Form -->
            <div class="col-md-7">
                <div class="card p-4">
                    <h4>Billing Details</h4>
                    <form id="checkout-form" method="POST" action="{{ route('processOrder') }}">
                        @csrf

                        <!-- Hidden field for selected cart items -->
                        @if(isset($selected_cart_ids))
                            @foreach($selected_cart_ids as $cartId)
                                <input type="hidden" name="selected_cart_ids[]" value="{{ $cartId }}">
                            @endforeach
                        @endif

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                                   id="fullname" name="fullname" placeholder="John Doe"
                                   value="{{ old('fullname') }}" required>
                            @error('fullname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" placeholder="you@example.com"
                                   value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                   id="phone" name="phone" placeholder="+855 12 345 678"
                                   value="{{ old('phone') }}" required>
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Shipping Address <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('address') is-invalid @enderror"
                                      id="address" name="address" rows="3"
                                      placeholder="123 Main St, City, Province" required>{{ old('address') }}</textarea>
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Order Notes (Optional)</label>
                            <textarea class="form-control" id="notes" name="notes" rows="2"
                                      placeholder="Any special instructions...">{{ old('notes') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Payment Method <span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method"
                                       id="cod" value="cod" {{ old('payment_method', 'cod') == 'cod' ? 'checked' : '' }}>
                                <label class="form-check-label" for="cod">
                                    <i class="fas fa-money-bill-wave me-2"></i>Cash on Delivery
                                    <small class="text-muted d-block">Pay when you receive your order</small>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method"
                                       id="credit" value="credit" {{ old('payment_method') == 'credit' ? 'checked' : '' }}>
                                <label class="form-check-label" for="credit">
                                    <i class="fas fa-credit-card me-2"></i>Credit Card
                                    <small class="text-muted d-block">Secure online payment</small>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method"
                                       id="bank_transfer" value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}>
                                <label class="form-check-label" for="bank_transfer">
                                    <i class="fas fa-university me-2"></i>Bank Transfer
                                    <small class="text-muted d-block">Transfer to our bank account</small>
                                </label>
                            </div>
                            @error('payment_method')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-shopping-bag me-2"></i>Place Order
                        </button>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-md-5">
                <div class="card p-4">
                    <h4>Order Summary</h4>
                    @if(isset($cart_items) && count($cart_items) > 0)
                        <ul class="list-group mb-3">
                            @php $subtotal = 0; @endphp
                            @foreach($cart_items as $item)
                                @php
                                    $item_total = $item['price'] * $item['quantity'];
                                    $subtotal += $item_total;
                                @endphp
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="my-0">{{ $item['name'] }}</h6>
                                        <small class="text-muted">Qty: {{ $item['quantity'] }} × ${{ number_format($item['price'], 2) }}</small>
                                    </div>
                                    <span>${{ number_format($item_total, 2) }}</span>
                                </li>
                            @endforeach

                            <li class="list-group-item d-flex justify-content-between">
                                <span>Subtotal</span>
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between">
                                <span>Shipping</span>
                                <span class="text-success">
                                @if($subtotal >= 2.00)
                                        Free
                                    @else
                                        $2.00
                                    @endif
                            </span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Total</strong>
                                <strong class="text-primary">${{ number_format($subtotal + ($subtotal >= 2.00 ? 0 : 2.00), 2) }}</strong>
                            </li>
                        </ul>

                        @php $total = $subtotal + ($subtotal >= 2.00 ? 0 : 2.00); @endphp
                        @if($subtotal >= 2.00)
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>
                                Free shipping applied! 🎉
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Add ${{ number_format(2.00 - $subtotal, 2) }} more for free shipping
                            </div>
                        @endif

                        <div class="d-grid gap-2">
                            <a href="{{ route('cart') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Cart
                            </a>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Your cart is empty. <a href="{{ route('shop') }}" class="alert-link">Continue shopping</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('checkout-form').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing Order...';

            // Re-enable button after 15 seconds as fallback
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }, 15000);
        });

        // Validate that we have selected cart items
        document.addEventListener('DOMContentLoaded', function() {
            const selectedCartIds = document.querySelectorAll('input[name="selected_cart_ids[]"]');
            if (selectedCartIds.length === 0) {
                alert('No items selected for checkout. Redirecting to cart...');
                window.location.href = '{{ route("cart") }}';
            }
        });
    </script>
@endsection
