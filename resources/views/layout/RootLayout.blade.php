<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- fontawesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- bootstrap cdn --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Document</title>
</head>
<body>
    {{-- Header --}}
    <section class="header-section">
        <header>
            <div class="container">

                    <a href="/"><img src="{{ asset('images/ZANDO-NEW-LOGO-2025.png') }}" alt="logo"></a>
                    {{-- navbar --}}
                    <nav>
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="/">Shop</a></li>
                            <li><a href="/">Blog</a></li>
                            <li><a href="/">About Us</a></li>
                        </ul>
                    </nav>
                    <div class="socail">
                        <a href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                        <a href="#"><i class="fa-regular fa-heart"></i></a>
                        <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                        <a href="#"><i class="fa-regular fa-user"></i></a>
                    </div>

            </div>
        </header>
    </section>

    <div class="content-wrapper">
        @yield('content')
    </div>


    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
