@extends('layout.RootLayout')
@section('content')
    <div class="d-flex justify-content-between align-items-center py-3">
        <h5>New Items (249)</h5>
        {{-- filter --}}
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Sort by: Product Recommend
            </button>
            <ul class="dropdown-menu ">
                <li><a class="dropdown-item" style="padding-right: 5.5rem;" href="#">New Items</a></li>
                <li><a class="dropdown-item" style="padding-right: 5.5rem;" href="#">Price (High First)</a></li>
                <li><a class="dropdown-item" style="padding-right: 5.5rem;" href="#">Price (Low First)</a></li>
                <li><a class="dropdown-item" style="padding-right: 5.5rem;" href="#">Discount (High First)</a></li>
                <li><a class="dropdown-item" style="padding-right: 5.5rem;" href="#">Discount (Low First)</a></li>
            </ul>
        </div>
    </div>
    <img src="https://zandokh.com/image/catalog/banner/2025/ZANDO/Augst/10 year/10Year80OFF 2160x534.jpg" class="w-100"
        alt="banner">
    {{-- product card --}}
        <div class="container">
            <div class="row">
                @foreach ($product as $item)
                    <div class="col-md-3">
                        <div class="product-card">
                            <span class="discount-tag">{{ $item->category }}</span>
                            <span class="wishlist">
                                <svg width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                                    <path
                                        d="M8 14s6-4.435 6-8.182C14 2.842 11.985 1 8 1S2 2.842 2 5.818C2 9.565 8 14 8 14z" />
                                </svg>
                            </span>
                            <img src="{{ $item->image }}" alt="Refined Serpent Jacket">
                            <div class="card-body">
                                <div class="product-title product-title-clipped">{{ $item->name }}</div>
                                <div>
                                    <span class="price">US ${{ $item->price }}</span>
                                    <span class="old-price">US ${{ $item->price + random_int(1, 5) }}</span>
                                </div>
                                <button class="btn btn-dark add-cart-btn" @click="addToCart({{ $item->id }})">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
@endsection
