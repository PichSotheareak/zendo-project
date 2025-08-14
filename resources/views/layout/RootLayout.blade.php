<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- fontawesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- bootstrap cdn --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- aos --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div id="app">
        {{-- Header --}}
        <section class="header-section">
            <header>
                <div class="container navbar">
                    {{-- hamburger menu --}}
                    <div class="d-flex align-items-center">
                        <button class="navbar-toggle d-block d-md-block d-lg-none" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon "></span>

                        </button>
                        {{-- logo --}}
                        <a href="/" class="ms-2 ms-lg-0 "><img src="{{ asset('images/ZANDO-NEW-LOGO-2025.png') }}"
                                alt="logo"></a>
                    </div>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                        aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="/shop">Shop</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="/blog">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="/about">About Us</a>
                                </li>
                            </ul>
                            {{-- <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                        <button class="btn btn-outline-success" type="submit">Search</button> --}}
                            </form>
                        </div>
                    </div>

                    {{-- navbar --}}
                    <nav>
                        <ul class="d-none  d-lg-flex">
                            <li><a href="/">Home</a></li>
                            <li><a href="/shop">Shop</a></li>
                            <li><a href="/blog">Blog</a></li>
                            <li><a href="/about">About Us</a></li>
                        </ul>
                    </nav>
                    <div class="socail d-flex gap-2 gap-lg-4">
                        <a href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                        <a href="#"><i class="fa-regular fa-heart"></i></a>
                        <a href="/cart"><i class="fa-solid fa-cart-shopping"></i></a>
                        <a href="#"><i class="fa-regular fa-user"></i></a>
                    </div>

                </div>
            </header>
        </section>

        <div class="content-wrapper container ">
            @yield('content')
        </div>

        {{-- footer --}}
        <footer class="container px-2 my-5">
            <section class="row text-center text-md-start g-4 border-bottom pb-3">
                <!-- Zando app qr -->
                <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <h6 class="fw-bold text-uppercase mb-2">zando app</h6>
                    <img src="https://zandokh.com/image/catalog/logo/qr_code_app.png" alt="zando qr" class="img-fluid"
                        style="width: 80px;" />
                </div>

                <!-- Loyalty -->
                <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <h6 class="fw-bold text-uppercase mb-2">loyalty</h6>
                    <p class="text-uppercase m-0">Membership &amp; Benefits</p>
                </div>

                <!-- Follow us -->
                <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <h6 class="fw-bold text-uppercase mb-2">follow us</h6>
                    <div class="d-flex flex-column gap-2 text-start">
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa-brands fa-facebook"></i>
                            <p class="text-capitalize m-0">Facebook</p>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa-brands fa-instagram"></i>
                            <p class="text-capitalize m-0">Instagram</p>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa-brands fa-tiktok"></i>
                            <p class="text-capitalize m-0">Tik Tok</p>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa-brands fa-youtube"></i>
                            <p class="text-capitalize m-0">YouTube</p>
                        </div>
                    </div>
                </div>

                <!-- Customer service -->
                <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <h6 class="fw-bold text-uppercase mb-2">customer service</h6>
                    <div class="d-flex flex-column gap-2 text-start">
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa-solid fa-circle-question"></i>
                            <p class="m-0">Online exchange policy</p>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa-solid fa-shield-halved"></i>
                            <p class="text-capitalize m-0">privacy policy</p>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa-solid fa-comment-dots"></i>
                            <p class="m-0">FAQs &amp; guides</p>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa-solid fa-location-dot"></i>
                            <p class="m-0">Find a store</p>
                        </div>
                    </div>
                </div>

                <!-- Contact us -->
                <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <h6 class="fw-bold text-uppercase mb-2">contact us</h6>
                    <div class="d-flex flex-column gap-2 text-start">
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa-solid fa-envelope"></i>
                            <p class="m-0">info@zandokh.com</p>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa-solid fa-phone"></i>
                            <p class="text-capitalize m-0">(+855) 081 999 716</p>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa-solid fa-phone"></i>
                            <p class="m-0">(+855) 061 330 330</p>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <i class="fa-brands fa-telegram"></i>
                            <p class="m-0">Telegram</p>
                        </div>
                    </div>
                </div>


                <!-- We accept -->
                <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <h6 class="fw-bold text-uppercase mb-2">we accept</h6>
                    <img src="https://zandokh.com/image/catalog/logo/web-footer/We-accept-payment%E2%80%93for-web-footer-1.png"
                        alt="payment" class="img-fluid" />
                </div>
            </section>

            <section class="mt-5 mb-4 text-end">
                © 2015 -
                <script>
                    document.write(new Date().getFullYear())
                </script> Zando. All rights reserved.
            </section>
        </footer>
    </div>
    @include('share.script')
    <script>
        const {
            createApp
        } = Vue

        createApp({
            delimiters: ['[[', ']]'],
            data() {
                return {
                    message: 'Hello Vue!',
                    cart_list: []
                }
            },
            methods: {
                addToCart(product_id) {
                    let url = '{{ route('addToCart') }}'
                    $.LoadingOverlay("show");
                    vm = this
                    axios.post(url, {
                            product_id: product_id
                        })
                        .then(function(response) {
                            vm.cart_list = response.data.cart_list
                            let cart_count_label = document.getElementById('cart_count_label')
                            cart_count_label.innerText = (vm.cart_list).length
                            Swal.fire({
                                position: "top-start",
                                icon: "success",
                                title: "Your product has been add to cart",
                                showConfirmButton: false,
                                timer: 1500
                            });

                        })
                        .catch(function(error) {
                            console.log(error);
                        }).finally(function() {
                            $.LoadingOverlay("hide");
                        });
                }
            }
        }).mount('#app')
    </script>



</body>

</html>
