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
    <div class="row my-5 g-4">
        <!-- Product Card -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="w-100" style="cursor: pointer; transition: transform 0.2s;">
                <!-- Image section -->
                <div class="position-relative overflow-hidden" style="height: 18rem;">
                    <img src="https://zandokh.com/image/cache/catalog/products/2025-08/12225031181/ZANDO020820251624-cr-450x672.jpg"
                        alt="Product Title" class="w-100 h-100" style="object-fit: cover;" />
                    <p class="bg-danger px-2 py-1 fw-semibold rounded text-white position-absolute top-0 start-0 m-2">
                        -20%
                    </p>
                </div>

                <!-- Description section -->
                <div class="p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-1">
                            <p class="text-danger fw-bold mb-0">US $80</p>
                            <p class="text-muted text-decoration-line-through mb-0">US $100</p>
                        </div>
                        <i class="far fa-heart" style="cursor: pointer; line-height: 1;"></i>
                    </div>
                    <p class="text-capitalize text-truncate  mt-1 mb-0" title="Product Title">
                        Product Title
                    </p>
                </div>
            </div>
        </div>

        <!-- Product Card -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="w-100" style="cursor: pointer; transition: transform 0.2s;">
                <!-- Image section -->
                <div class="position-relative overflow-hidden" style="height: 18rem;">
                    <img src="https://zandokh.com/image/cache/catalog/products/2025-08/12225031181/ZANDO020820251624-cr-450x672.jpg"
                        alt="Product Title" class="w-100 h-100" style="object-fit: cover;" />
                    <p class="bg-danger px-2 py-1 fw-semibold rounded text-white position-absolute top-0 start-0 m-2">
                        -20%
                    </p>
                </div>

                <!-- Description section -->
                <div class="p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-1">
                            <p class="text-danger fw-bold mb-0">US $80</p>
                            <p class="text-muted text-decoration-line-through mb-0">US $100</p>
                        </div>
                        <i class="far fa-heart" style="cursor: pointer; line-height: 1;"></i>
                    </div>
                    <p class="text-capitalize text-truncate mt-1 mb-0" title="Product Title">
                        Product Title
                    </p>
                </div>
            </div>
        </div>

        <!-- Product Card -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="w-100" style="cursor: pointer; transition: transform 0.2s;">
                <!-- Image section -->
                <div class="position-relative overflow-hidden" style="height: 18rem;">
                    <img src="https://zandokh.com/image/cache/catalog/products/2025-08/12225031181/ZANDO020820251624-cr-450x672.jpg"
                        alt="Product Title" class="w-100 h-100" style="object-fit: cover;" />
                    <p class="bg-danger px-2 py-1 fw-semibold rounded text-white position-absolute top-0 start-0 m-2">
                        -20%
                    </p>
                </div>

                <!-- Description section -->
                <div class="p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-1">
                            <p class="text-danger fw-bold mb-0">US $80</p>
                            <p class="text-muted text-decoration-line-through mb-0">US $100</p>
                        </div>
                        <i class="far fa-heart" style="cursor: pointer; line-height: 1;"></i>
                    </div>
                    <p class="text-capitalize text-truncate mt-1 mb-0" title="Product Title">
                        Product Title
                    </p>
                </div>
            </div>
        </div>

        <!-- Product Card -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="w-100" style="cursor: pointer; transition: transform 0.2s;">
                <!-- Image section -->
                <div class="position-relative overflow-hidden" style="height: 18rem;">
                    <img src="https://zandokh.com/image/cache/catalog/products/2025-08/12225031181/ZANDO020820251624-cr-450x672.jpg"
                        alt="Product Title" class="w-100 h-100" style="object-fit: cover;" />
                    <p class="bg-danger px-2  py-1 fw-semibold rounded text-white position-absolute top-0 start-0 m-2">
                        -20%
                    </p>
                </div>

                <!-- Description section -->
                <div class="p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-1">
                            <p class="text-danger fw-bold mb-0">US $80</p>
                            <p class="text-muted text-decoration-line-through mb-0">US $100</p>
                        </div>
                        <i class="far fa-heart" style="cursor: pointer; line-height: 1;"></i>
                    </div>
                    <p class="text-capitalize text-truncate mt-1 mb-0" title="Product Title">
                        Product Title
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
