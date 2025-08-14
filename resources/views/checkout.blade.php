@extends('layout.RootLayout')
@section('content')
<div class="container">
        <h2 class="mb-4 text-center">🧾 Checkout</h2>
        <div class="row">
            <!-- Billing Form -->
            <div class="col-md-7">
                <div class="card p-4">
                    <h4>Billing Details</h4>
                    <form>
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" class="form-control" id="fullname" placeholder="John Doe">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="you@example.com">
                        </div>
                        <div class="form-group">
                            <label for="address">Shipping Address</label>
                            <input type="text" class="form-control" id="address" placeholder="123 Main St">
                        </div>

                        <div class="form-group">
                            <label>Payment Method</label><br>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="cod" checked>
                                <label class="form-check-label" for="cod">
                                    Cash on Delivery
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="credit">
                                <label class="form-check-label" for="credit">
                                    Credit Card
                                </label>
                            </div>
                        </div>

                        <button class="btn btn-primary">Place Order</button>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-md-5">
                <div class="summary">
                    <h4>Order Summary</h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <h6 class="my-0">Coca Cola (x2)</h6>
                            </div>
                            <span>$1.00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <h6 class="my-0">Pepsi (x3)</h6>
                            </div>
                            <span>$1.80</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Total</strong>
                            <strong>$2.80</strong>
                        </li>
                    </ul>
                    <p class="text-muted">Shipping is free for orders over $2.00 🎉</p>
                </div>
            </div>
        </div>
    </div>
@endsection
