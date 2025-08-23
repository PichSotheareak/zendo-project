@extends('frontend.layout.RootLayout')
@section('content')
    <div class="container my-5">
        <h2 class="mb-4 text-center">Your Shopping Cart</h2>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (isset($cart_items) && count($cart_items) > 0)
            <form id="checkout-form" method="GET" action="{{ route('checkout') }}">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="select-all" class="form-check-input">
                                </th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart_items as $item)
                                <tr id="cart-item-{{ $item->cart_id }}">
                                    <td>
                                        <input type="checkbox" class="item-checkbox" name="selected_products[]"
                                            value="{{ $item->cart_id }}">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item->image ?? '/images/no-image.png' }}"
                                                alt="{{ $item->name }}" class="me-3 rounded"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                            <div>
                                                <h6 class="mb-0">{{ $item->name }}</h6>
                                                @if (isset($item->description))
                                                    <small
                                                        class="text-muted">{{ Str::limit($item->description, 50) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>
                                        <input type="number" class="form-control quantity-input"
                                            data-cart-id="{{ $item->cart_id }}" data-price="{{ $item->price }}"
                                            value="{{ $item->quantity }}" min="1"
                                            @change="updateCartQuantity({{ $item->cart_id }}, $event.target.value)">
                                    </td>
                                    <td class="item-total">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger"
                                            @click="removeCartItem({{ $item->cart_id }})">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row justify-content-end">
                    <div class="col-md-4">
                        <div class="card p-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Selected Items Total:</span>
                                <span id="selected-total">$0.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping:</span>
                                <span id="shipping-cost">$0.00</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Cart Total:</strong>
                                <strong
                                    id="cart-grand-total">${{ number_format($cart_items->sum(fn($i) => $i->price * $i->quantity), 2) }}</strong>
                            </div>

                            <div class="mb-3">
                                <span id="selected-count">0 items selected</span>
                            </div>

                            <div id="shipping-message" class="mb-3"></div>

                            <button type="button" class="btn btn-outline-primary mb-2"
                                onclick="window.location.href='{{ route('shop') }}'">
                                <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                            </button>

                            <button type="button" class="btn btn-warning mb-2" onclick="clearCart()">
                                <i class="fas fa-trash me-2"></i>Clear Cart
                            </button>

                            <button type="submit" class="btn btn-primary" id="checkout-btn" disabled>
                                Proceed to Checkout ($0.00)
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-shopping-cart text-muted" style="font-size: 4rem;"></i>
                            <h3 class="mt-3">Your Cart is Empty</h3>
                            <p class="text-muted">Start adding items to your cart to see them here.</p>
                            <a href="{{ route('shop') }}" class="btn btn-primary">
                                <i class="fas fa-shopping-bag me-2"></i>Start Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const itemCheckboxes = document.querySelectorAll('.item-checkbox');
            const checkoutBtn = document.getElementById('checkout-btn');
            const selectedCountSpan = document.getElementById('selected-count');
            const selectedTotalSpan = document.getElementById('selected-total');
            const shippingCostSpan = document.getElementById('shipping-cost');
            const shippingMessage = document.getElementById('shipping-message');

            function updateCheckoutButton() {
                const selectedCheckboxes = document.querySelectorAll('.item-checkbox:checked');
                const selectedCount = selectedCheckboxes.length;

                if (selectedCount > 0) {
                    let selectedTotal = 0;

                    selectedCheckboxes.forEach(cb => {
                        const row = cb.closest('tr');
                        const quantityInput = row.querySelector('.quantity-input');
                        const price = parseFloat(quantityInput.dataset.price);
                        const quantity = parseInt(quantityInput.value);
                        selectedTotal += price * quantity;
                    });

                    const shipping = selectedTotal >= 2.00 ? 0 : 2.00;
                    const finalTotal = selectedTotal + shipping;

                    checkoutBtn.disabled = false;
                    checkoutBtn.innerHTML =
                        `<i class="fas fa-credit-card me-2"></i>Proceed to Checkout ($${finalTotal.toFixed(2)})`;
                    selectedCountSpan.textContent = `${selectedCount} item${selectedCount > 1 ? 's' : ''} selected`;
                    selectedTotalSpan.textContent = `$${selectedTotal.toFixed(2)}`;
                    shippingCostSpan.textContent = shipping > 0 ? `$${shipping.toFixed(2)}` : 'Free';

                    if (shipping === 0) {
                        shippingMessage.innerHTML =
                            '<p class="text-success mb-0"><i class="fas fa-check-circle me-2"></i>Free shipping applied! 🎉</p>';
                    } else {
                        const needed = 2.00 - selectedTotal;
                        shippingMessage.innerHTML =
                            `<p class="text-muted mb-0"><i class="fas fa-info-circle me-2"></i>Add $${needed.toFixed(2)} more for free shipping</p>`;
                    }
                } else {
                    checkoutBtn.disabled = true;
                    checkoutBtn.innerHTML = '<i class="fas fa-credit-card me-2"></i>Proceed to Checkout ($0.00)';
                    selectedCountSpan.textContent = '0 items selected';
                    selectedTotalSpan.textContent = '$0.00';
                    shippingCostSpan.textContent = '$0.00';
                    shippingMessage.innerHTML = '';
                }
            }

            selectAllCheckbox?.addEventListener('change', function() {
                itemCheckboxes.forEach(cb => cb.checked = this.checked);
                updateCheckoutButton();
            });

            itemCheckboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    const allChecked = Array.from(itemCheckboxes).every(c => c.checked);
                    const noneChecked = Array.from(itemCheckboxes).every(c => !c.checked);
                    selectAllCheckbox.checked = allChecked;
                    selectAllCheckbox.indeterminate = !allChecked && !noneChecked;
                    updateCheckoutButton();
                });
            });

            updateCheckoutButton();

            document.getElementById('checkout-form')?.addEventListener('submit', function(e) {
                const selectedCheckboxes = document.querySelectorAll('.item-checkbox:checked');
                if (selectedCheckboxes.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one item to checkout.');
                    return false;
                }
                checkoutBtn.disabled = true;
                checkoutBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
            });
        });

        function clearCart() {
            if (!confirm('Are you sure you want to clear the cart?')) return;
            fetch('/cart/clear', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(res => location.reload())
                .catch(err => {
                    console.error(err);
                    alert('Error clearing cart.');
                });
        }
    </script>
@endsection
