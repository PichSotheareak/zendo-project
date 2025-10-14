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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <style>
        .user-section {
            display: inline-block;
            position: relative;
        }

        .login-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 6px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: transform 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
        }

        .login-btn i {
            font-size: 13px;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 6px;
            background-color: white;
            padding: 4px 10px;
            border-radius: 20px;
            cursor: pointer;
            border: 2px solid #e0e0e0;
            transition: all 0.3s;
        }

        .user-info:hover {
            border-color: #667eea;
        }

        .user-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
        }

        .user-greeting {
            font-size: 12px;
            color: #666;
            white-space: nowrap;
        }

        .dropdown-menu-custom {
            position: absolute;
            top: 120%;
            right: 0;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            min-width: 250px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .dropdown-menu-custom.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-header {
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .dropdown-user-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .dropdown-username {
            font-size: 12px;
            color: #666;
            margin-bottom: 3px;
        }

        .dropdown-name {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .dropdown-item-custom {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: background-color 0.2s;
            color: #333;
            text-decoration: none;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-size: 14px;
        }

        .dropdown-item-custom:hover {
            background-color: #f5f5f5;
            color: #333;
        }

        .dropdown-item-custom i {
            width: 20px;
            color: #667eea;
        }

        .dropdown-item-custom.logout {
            color: #e74c3c;
            border-top: 1px solid #e0e0e0;
        }

        .dropdown-item-custom.logout i {
            color: #e74c3c;
        }

        .hidden {
            display: none;
        }
    </style>
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
                <div class="socail d-flex gap-2 gap-lg-4 align-items-center">
                    <a href="#"><i class="fa-solid fa-magnifying-glass" style="font-size: 18px;"></i></a>
                    <a href="#"><i class="fa-regular fa-heart" style="font-size: 18px;"></i></a>
                    <div class="position-relative d-inline-block">
                        <a href="/cart" class="text-dark">
                            <i class="fa-solid fa-cart-shopping" style="font-size: 18px;"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger px-2 py-1"
                                style="font-size: 0.65rem;">
                                    [[ cartCount ]]
                                </span>
                        </a>
                    </div>

                    {{-- Login Button and Dropdown --}}
                    <div class="user-section">
                        @guest
                            <!-- Login Button (shown when not logged in) -->
                            <a href="{{ route('login') }}" class="login-btn">
                                <i class="fa-solid fa-right-to-bracket"></i> Login
                            </a>
                        @else
                            <!-- User Info (shown when logged in) -->
                            <div class="user-info" onclick="toggleDropdown()">
                                <div class="user-icon">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <span class="user-greeting">Hi, {{ Str::limit(Auth::user()->first_name, 10) }}</span>
                                <i class="fa-solid fa-chevron-down" style="color: #999; font-size: 10px;"></i>
                            </div>

                            <!-- Dropdown Menu -->
                            <div class="dropdown-menu-custom" id="dropdownMenu">
                                <div class="dropdown-header">
                                    <div class="dropdown-user-icon">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div class="dropdown-username">Email: {{ Auth::user()->email }}</div>
                                    <div class="dropdown-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                                </div>

                                @if(Auth::user()->role == 'admin' || Auth::user()->is_admin == 1)
                                    <a href="/admin/dashboard" class="dropdown-item-custom">
                                        <i class="fa-solid fa-gauge"></i>
                                        Dashboard
                                    </a>
                                @endif

                                <a href="/shop" class="dropdown-item-custom">
                                    <i class="fa-solid fa-shopping-bag"></i>
                                    My Orders
                                </a>
                                <a href="/profile" class="dropdown-item-custom">
                                    <i class="fa-solid fa-user-circle"></i>
                                    My Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="dropdown-item-custom logout">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        @endguest
                    </div>
                </div>

            </div>
        </header>
    </section>

    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

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

@include('frontend.share.script')
<script>
    // Toggle dropdown for logged in users
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdownMenu');
        if (dropdown) {
            dropdown.classList.toggle('active');
        }
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const userSection = document.querySelector('.user-section');
        const dropdown = document.getElementById('dropdownMenu');

        if (dropdown && userSection && !userSection.contains(e.target)) {
            dropdown.classList.remove('active');
        }
    });

    // Vue App
    const {
        createApp
    } = Vue;

    createApp({
        delimiters: ['[[', ']]'],
        data() {
            return {
                qty: 1,
                stock: {{ $product->stock ?? 100 }},
                cart_list: [],
                cartCount: {{ $cart_count ?? 0 }}
            }
        },
        methods: {
            increaseQty() {
                if (this.qty < this.stock) this.qty++;
            },
            decreaseQty() {
                if (this.qty > 1) this.qty--;
            },
            addToCart(product_id) {
                let url = '{{ route('addToCart') }}';
                let vm = this;
                $.LoadingOverlay("show");

                axios.post(url, {
                    product_id: product_id,
                    quantity: this.qty
                })
                    .then(function(response) {
                        vm.cart_list = response.data.cart_list;
                        vm.cartCount = response.data.cart_count;

                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Your product has been added to cart",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
                    .catch(function(error) {
                        console.log(error);
                    })
                    .finally(function() {
                        $.LoadingOverlay("hide");
                    });
            },
            getCartCount() {
                let url = '{{ route('getCartCount') }}';
                let vm = this;

                axios.get(url)
                    .then(function(response) {
                        vm.cartCount = response.data.cart_count;
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
            updateCartQuantity(cart_id, new_quantity) {
                new_quantity = parseInt(new_quantity);

                if (new_quantity < 1) {
                    return;
                }

                let url = '{{ route('updateCartQuantity') }}';
                let vm = this;

                $.LoadingOverlay("show");

                axios.post(url, {
                    cart_id: cart_id,
                    quantity: new_quantity
                })
                    .then(function(response) {
                        if (response.data.success) {
                            let input = document.querySelector(`input[data-cart-id="${cart_id}"]`);
                            if (input) {
                                input.value = new_quantity;

                                let price = parseFloat(input.dataset.price);
                                let itemTotal = price * new_quantity;
                                let itemRow = document.querySelector(`#cart-item-${cart_id}`);
                                if (itemRow) {
                                    itemRow.querySelector('.item-total').textContent = '$' + itemTotal
                                        .toFixed(2);
                                }
                            }

                            vm.updateGrandTotal();
                            vm.cartCount = response.data.cart_count;

                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Quantity updated successfully",
                                showConfirmButton: false,
                                timer: 1000
                            });

                            document.dispatchEvent(new Event('change'));
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Failed to update quantity",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.location.reload();
                    })
                    .finally(function() {
                        $.LoadingOverlay("hide");
                    });
            },

            updateGrandTotal() {
                let total = 0;
                let cartItems = document.querySelectorAll('tbody tr[id^="cart-item-"]');

                cartItems.forEach(function(row) {
                    let input = row.querySelector('.quantity-input');
                    if (input) {
                        let price = parseFloat(input.dataset.price);
                        let quantity = parseInt(input.value);
                        total += price * quantity;
                    }
                });

                let grandTotalElement = document.querySelector('#cart-grand-total');
                if (grandTotalElement) {
                    grandTotalElement.textContent = '$' + total.toFixed(2);
                }
            },

            removeCartItem(cart_id) {
                let url = `/cart/remove/${cart_id}`;
                let vm = this;

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.LoadingOverlay("show");

                        axios.delete(url)
                            .then(function(response) {
                                if (response.data.success) {
                                    let itemRow = document.querySelector(`#cart-item-${cart_id}`);
                                    if (itemRow) {
                                        itemRow.remove();
                                    }

                                    vm.updateGrandTotal();
                                    vm.cartCount = response.data.cart_count;

                                    let remainingItems = document.querySelectorAll(
                                        'tbody tr[id^="cart-item-"]');
                                    if (remainingItems.length === 0) {
                                        let tbody = document.querySelector('tbody');
                                        if (tbody) {
                                            tbody.innerHTML =
                                                '<tr id="empty-cart-row"><td colspan="5" class="text-center">Your cart is empty.</td></tr>';
                                        }
                                        let checkoutBtn = document.querySelector(
                                            '.btn-primary.float-end');
                                        if (checkoutBtn) {
                                            checkoutBtn.style.display = 'none';
                                        }
                                    }

                                    Swal.fire({
                                        position: "center",
                                        icon: "success",
                                        title: "Item removed successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            })
                            .catch(function(error) {
                                console.log(error);
                                Swal.fire({
                                    position: "center",
                                    icon: "error",
                                    title: "Failed to remove item",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            })
                            .finally(function() {
                                $.LoadingOverlay("hide");
                            });
                    }
                });
            }
        }
    }).mount('#app');
</script>

</body>

</html>
