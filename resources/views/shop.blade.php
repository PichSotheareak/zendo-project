@extends('layout.RootLayout')
@section('content')
    <div class="d-flex justify-content-between align-items-center py-3">
        <h5>All Items ({{$count}})</h5>
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
    <div class="container my-5">
        <div class="row">
            @foreach ($products as $item)
                <div class="col-md-3 ">
                    <div  style="width: 18rem;">
                        <!-- Image Section -->
                        <div class="position-relative">
                            <img src="{{ $item->image }}" class="card-img-top" alt="{{ $item->name }}"
                                style="height: 400px; object-fit: cover;">
                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                                -{{ $item->discount }}%
                            </span>
                        </div>

                        <!-- Description Section -->
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <span class="text-danger fw-bold">US ${{ $item->price }}</span>
                                    <small class="text-muted text-decoration-line-through ms-2">
                                        US ${{ number_format($item->price / (1 - $item->discount / 100), 2) }}
                                    </small>
                                </div>
                                <i class="far fa-heart text-muted"></i>
                            </div>
                            <p class="card-text text-capitalize text-truncate mb-0 product-title-clipped">
                                {{ $item->name }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
