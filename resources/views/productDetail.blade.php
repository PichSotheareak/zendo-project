@extends('layout.RootLayout')
@section('content')
    <div class="container my-5">
        <div class="row g-4">
            <!-- Images -->
            <div class="col-lg-6 d-flex justify-content-center gap-3">

                <!-- Main Image -->
                <div>
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid"
                        style="max-height: 500px; object-fit: cover;">
                </div>
            </div>

            <!-- Product Detail -->
            <div class="col-lg-6">
                <!-- Price and Share -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <!-- Price -->
                    <div class="d-flex gap-2 align-items-center fs-5">
                        <h4 class="text-danger fw-bold mb-0">US ${{ $product->price }}</h4>
                        <span class="fw-bold text-dark">-{{ $product->discount }}%</span>
                        <span class="fw-semibold text-muted text-decoration-line-through">
                            US ${{ number_format($product->price / (1 - $product->discount / 100), 2) }}
                        </span>
                    </div>

                    <!-- Share -->
                    <button class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </button>

                </div>

                <!-- Product Name -->
                <p class="text-capitalize my-3 fs-5">{{ $product->name }}</p>

                <!-- Size -->
                <div class="my-4">
                    <p class="fw-semibold mb-2">Size</p>
                    <div class="d-flex gap-2 flex-wrap">
                        <button class="btn btn-outline-dark text-uppercase">S</button>
                        <button class="btn btn-outline-dark text-uppercase">M</button>
                        <button class="btn btn-outline-dark text-uppercase">L</button>
                        <button class="btn btn-outline-dark text-uppercase disabled">XL</button>
                    </div>
                </div>

                <!-- Quantity -->
                <div class="my-4">
                    <p class="fw-semibold mb-2">Quantity</p>
                    <div class="d-flex gap-2 align-items-center">
                        <button class="btn btn-outline-dark">-</button>
                        <span class="px-4 py-2 border bg-light">1</span>
                        <button class="btn btn-outline-dark" >+</button>
                    </div>
                    {{-- <p class="text-danger mt-2">Out of stock for this size</p> --}}
                </div>

                <!-- Add to Bag -->
                <div class="my-4 d-flex gap-3 align-items-center">
                    <button class="btn btn-dark w-100 fw-bold py-3" @click="addToCart({{ $product->id }})">
                        Add to Bag
                    </button>
                    <button class="btn btn-light border">
                        <i class="bi bi-heart fs-4"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection()
