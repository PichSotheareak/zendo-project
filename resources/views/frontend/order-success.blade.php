@extends('frontend.layout.RootLayout')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-success">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                        <h2 class="mt-3 text-success">Order Placed Successfully!</h2>
                        <p class="text-muted">Thank you for your order. We'll process it shortly.</p>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h5>Order Details</h5>
                                        <p class="mb-1"><strong>Order ID:</strong> #{{ $order->id }}</p>
                                        <p class="mb-1"><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
                                        <p class="mb-1"><strong>Payment:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                                        <p class="mb-0"><strong>Status:</strong> <span class="badge bg-warning">{{ ucfirst($order->status) }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h5>Shipping Information</h5>
                                        <p class="mb-1"><strong>Name:</strong> {{ $order->fullname }}</p>
                                        <p class="mb-1"><strong>Email:</strong> {{ $order->email }}</p>
                                        <p class="mb-1"><strong>Phone:</strong> {{ $order->phone }}</p>
                                        <p class="mb-0"><strong>Address:</strong> {{ $order->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('shop') }}" class="btn btn-primary me-2">
                                <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-home me-2"></i>Go Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
