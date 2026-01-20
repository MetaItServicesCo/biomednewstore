<style>
    /* Hover par icon show */
    /* .nav-repair-title:hover i {
        opacity: 1;
        transform: translateX(0);
    } */
    .nav-link {
        position: relative;
        padding-bottom: 6px;
    }

    .nav-link::after {
        content: "";
        position: absolute;
        left: 50%;
        bottom: 0;
        width: 0;
        height: 3px;
        background-color: #FE0000;
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .nav-link.active::after {
        width: 60%;
        left: 44%;

    }

    /* ===== FORCE STICKY HEADER ===== */


    .site-header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 10000;
        transition: transform 0.3s ease-in-out;
    }

    .site-header.hide-header {
        transform: translateY(-100%);
    }

    .site-header.show-header {
        transform: translateY(0);
    }

    .mega-menu {
        position: absolute;
        z-index: 99999;
    }
</style>
<header class="site-header " id="siteHeader">
    <nav class="navbar navbar-expand-lg navbar-light bg-white p-0 ">
        <div class="container-fluid d-flex align-items-center p-0 position-relative">

            <!-- Logo -->
            <a class="navbar-brand px-3 " href="#">
                <img src="{{ asset('storage/' . setting('site_logo', 'frontend/images/logo.png')) }}" height=""
                    alt="{{ setting('site_name') }}" class="img-fluid nav-logo">
            </a>

            <button class="navbar-toggler me-3" type="button" id="customToggler" aria-controls="mainNav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="mainNav">
                <ul
                    class="navbar-nav blue-block d-flex flex-lg-row flex-column align-items-lg-center align-items-start  ">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products') ? 'active' : '' }}"
                            href="{{ route('products') }}">MrBioMed Store</a>
                    </li>

                    <li class="nav-item dropdown  has-mega">
                        <a class="nav-link mega-toggle" href="javascript:void(0)">
                            Categories List
                            <i class="bi bi-chevron-down dropdown-icon"></i>
                        </a>
                        <div class="mega-menu">
                            <div class="container-fluid nav-product">
                                <div class="row">
                                    @foreach ($headerCategories as $category)
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <h6 class="city-repair-title text-white">
                                                {{ $category->name }}
                                                <i class="fa-solid fa-angle-right"></i>
                                            </h6>
                                            @if ($category->products && $category->products->count() > 0)
                                                @foreach ($category->products as $product)
                                                    <p class="mt-3">
                                                        <a href="{{ route('product-detail', $product->slug) }}"
                                                            class="bottomm">
                                                            {{ $product->name }}
                                                        </a>
                                                    </p>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown has-mega">
                        <a class="nav-link mega-toggle" href="javascript:void(0)">Accessories<i
                                class="bi bi-chevron-down dropdown-icon"></i></a>
                        <div class="mega-menu">
                            <div class="container-fluid nav-product">
                                <div class="row">
                                    @foreach ($headerCategories as $category)
                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <h6 class="city-repair-title text-white">
                                                {{ $category->name }}
                                                <i class="fa-solid fa-angle-right"></i>
                                            </h6>
                                            @if ($category->products && $category->products->count() > 0)
                                                @foreach ($category->products as $product)
                                                    <p class="mt-3">
                                                        <a href="{{ route('product-detail', $product->slug) }}"
                                                            class="bottomm">
                                                            {{ $product->name }}
                                                        </a>
                                                    </p>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link  {{ request()->routeIs('parts') ? 'active' : '' }} " href="{{ route('parts') }}">
                            Parts
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ rtrim(env('BIO_MED_WEBSITE'), '/') }}/about">
                            About mbmts
                        </a>
                    </li>


                    <li class="nav-item ms-auto d-flex flex-column align-items-center mt-2 mt-lg-0">
                        <div class="d-flex align-items-center gap-4  contact-icons-wrapper me-2 mt-2">

                            <a href="{{ route('login') }}" target="_blank" class="d-flex">
                                <img src="{{ asset('frontend/images/nav-ico1.png') }}" class="icon-arrow">
                                <img src="{{ asset('frontend/images/nav-ico2.png') }}" class="icon-image">

                            </a>


                            <a href="{{ route('cart') }}" class="cart-icon-wrapper position-relative">
                                <img src="{{ asset('frontend/images/nav-ico.png') }}" class="icon-shop">

                                <span id="cart-count" class="cart-count-badge">
                                    {{ count(session('cart', [])) }}
                                </span>
                            </a>


                        </div>

                        <a href="{{ rtrim(env('BIO_MED_WEBSITE'), '/') }}/contact" class="btn contact-btn mt-1 px-3 py-">
                            CONTACT
                        </a>
                    </li>

                    {{-- <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                        @endguest

                        @auth
                           
                            <div class="dropdown">
                                <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                                    id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ auth()->user()->name ?? auth()->user()->email }}

                                </a>
                                <ul class="dropdown-menu" aria-labelledby="userMenu">
                                    @if (auth()->user()->hasRole('administrator'))
                                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                    @endif
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endauth
                    </li> --}}

                </ul>
            </div>

        </div>
    </nav>
</header>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById('siteHeader');
        let lastScrollTop = 0;

        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // small scroll ignore
            if (Math.abs(scrollTop - lastScrollTop) < 10) return;

            if (scrollTop > lastScrollTop && scrollTop > 150) {
                // SCROLL DOWN → hide
                header.classList.add('hide-header');
                header.classList.remove('show-header');
            } else {
                // SCROLL UP → show
                header.classList.remove('hide-header');
                header.classList.add('show-header');
            }

            lastScrollTop = scrollTop;
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggler = document.getElementById('customToggler');
        const mainNav = document.getElementById('mainNav');
        const isDesktop = () => window.innerWidth >= 992;

        // Toggler click → open/close menu
        toggler.addEventListener('click', function(e) {
            if (!isDesktop()) {
                mainNav.classList.toggle('show');
                const isExpanded = mainNav.classList.contains('show');
                toggler.setAttribute('aria-expanded', isExpanded);
            }
        });

        // Window resize → close menu on desktop
        window.addEventListener('resize', function() {
            if (isDesktop() && mainNav.classList.contains('show')) {
                mainNav.classList.remove('show');
                toggler.setAttribute('aria-expanded', false);
            }
        });

        // Click outside → close menu
        document.addEventListener('click', function(e) {
            if (!isDesktop() && mainNav.classList.contains('show')) {
                // agar click nav ya toggler ke bahar hai
                if (!mainNav.contains(e.target) && !toggler.contains(e.target)) {
                    mainNav.classList.remove('show');
                    toggler.setAttribute('aria-expanded', false);
                }
            }
        });
    });
</script>
