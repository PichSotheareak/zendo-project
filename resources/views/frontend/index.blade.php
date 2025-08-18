<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Phones (xs) */
        @media (max-width: 575.98px) {
            .brand img {
                height: 35px;
            }
        }

        /* Small devices (sm) */
        @media (min-width: 576px) and (max-width: 767.98px) {
            .brand img {
                height: 70px;
            }
        }

        /* Medium devices (md) */
        @media (min-width: 768px) and (max-width: 991.98px) {
            .brand img {
                height: 100px;
            }
        }

        /* Large devices (lg) */
        @media (min-width: 992px) and (max-width: 1199.98px) {
            .brand img {
                height: 100px;
            }
        }

        /* Extra Large devices (xl) */
        @media (min-width: 1200px) and (max-width: 1399.98px) {
            .brand img {
                height: 100px;
            }
        }

        /* XXL devices (xxl) */
        @media (min-width: 1400px) and (max-width: 2559.98px) {
            .brand img {
                height: 150px;
            }
        }

        /* 4K screens (custom) */
        @media (min-width: 2560px) {
            .brand img {
                height: 200px;
            }
        }
    </style>
</head>

<body>
    @extends('frontend.layout.RootLayout')
    @section('content')
        {{-- slider --}}
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="2000">
                    <img src="https://zandokh.com/image/catalog/banner/2025/ZANDO/Augst/10 year/10Year80OFF 2160x1066.jpg"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="https://zandokh.com/image/catalog/banner/2024/1st-purchase-banner.jpg" class="d-block w-100"
                        alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="https://zandokh.com/image/catalog/banner/2025/ZANDO/Augst/10 year/10Year80OFF 2160x1066.jpg"
                        class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        {{-- Brand --}}

        <div class="brand d-flex justify-content-between gap-3 align-items-center " style="cursor: pointer">
            <img src="https://zandokh.com/image/catalog/logo/zando/ZandoNoBorder.jpg" class="flex-grow-1"
                style="object-fit: contain;" alt="zando">
            <img src="https://zandokh.com/image/catalog/logo/ten11/Ten11NoBorder.jpg" class="flex-grow-1"
                style="object-fit: contain;" alt="ten11">
            <img src="https://zandokh.com/image/catalog/logo/gatoni/gatoni-logo.png" class="flex-grow-1"
                style="object-fit: contain;" alt="gatoni">
            <img src="https://zandokh.com/image/catalog/logo/Routine/RoutineNoBorder.jpg" class="flex-grow-1"
                style="object-fit: contain;" alt="Routine">
            <img src="https://zandokh.com/image/catalog/logo/361/361NoBorder.jpg" class="flex-grow-1"
                style="object-fit: contain;" alt="361">
            <img src="https://zandokh.com/image/catalog/logo/sisburma/2025-07-22%2012.02.25.jpg" class="flex-grow-1"
                style="object-fit: contain;" alt="sisburma">
        </div>

        {{-- style --}}
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4">
                    <img src="https://zandokh.com/image/catalog/banner/2025/ZANDO/Category%20lifestyle,%20sportlife,%20smartcasual/July/3.jpg"
                        class="img-fluid" alt="...">
                </div>
                <div class="col-12 col-md-4">
                    <img src="https://zandokh.com/image/catalog/banner/2025/ZANDO/Category%20lifestyle,%20sportlife,%20smartcasual/July/1.jpg"
                        class="img-fluid" alt="...">
                </div>
                <div class="col-12 col-md-4">
                    <img src="https://zandokh.com/image/catalog/banner/2025/ZANDO/Category%20lifestyle,%20sportlife,%20smartcasual/July/2.jpg"
                        class="img-fluid" alt="...">
                </div>
            </div>
        </div>
        {{-- top & bottom --}}
        <div class="container my-3">
            <div class="row">
                <div class="col-12 col-md-6">
                    <img src="https://zandokh.com/image/catalog/banner/2025/ZANDO/Category%20lifestyle,%20sportlife,%20smartcasual/July/4.jpg"
                        class="img-fluid" alt="...">
                </div>
                <div class="col-12 col-md-6">
                    <img src="https://zandokh.com/image/catalog/banner/2025/ZANDO/Category%20lifestyle,%20sportlife,%20smartcasual/July/5.jpg"
                        class="img-fluid" alt="...">
                </div>
            </div>
        </div>



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

</body>

</html>
