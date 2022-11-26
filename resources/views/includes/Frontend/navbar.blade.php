<section class="h-100 w-100" style="box-sizing: border-box; background-color: #fcfcff">
    <div class="header-5-1 container  mx-auto p-0 position-relative" style="font-family: 'Poppins', sans-serif">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="/">
                <img style="margin-right: 0.75rem" src="{{ asset('concoff/Logo_concoff.svg') }}" alt="main-logo" width="100" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="modal" data-bs-target="#targetModal-item">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="modal-item modal fade" id="targetModal-item" tabindex="-1" role="dialog" aria-labelledby="targetModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content bg-white border-0">
                        <div class="modal-header" style="padding: 2rem; padding-bottom: 0">
                            <a class="modal-title" id="targetModalLabel">
                                <img style="margin-top: 0.5rem" src="{{ asset('frontend/images/main-logo.png') }}" alt="main-logo" width="90" />
                            </a>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Mobile navbar -->
                        <div class="modal-body" style="padding: 2rem; padding-top: 0; padding-bottom: 0">
                            <ul class="navbar-nav responsive me-auto mt-2 mt-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" href="/">Home</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Products</a>
                                    <ul class="dropdown-menu" style="cursor: pointer">

                                        <li>
                                            <a href="{{ url('/product') }}" class="dropdown-hover d-flex align-items-center justify-content-center text-start text-decoration-none">
                                                <img class="" src="http://api.elements.buildwithangga.com/storage/files/2/assets/Header/Header5/Header-5-5.png" alt="" />
                                                <div class="flex-grow-1 ps-4">
                                                    <h2 class="icon-item-title">Our product</h2>
                                                    <p class="icon-item-caption" style="margin-bottom: 0">
                                                        Let's see our product
                                                    </p>
                                                </div>
                                                <svg class="dropdown-icon-arrow d-none" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14.5237 9.41999L10.7887 13.17C10.6687 13.29 10.5187 13.35 10.3687 13.35C10.2187 13.35 10.0687 13.29 9.94871 13.17C9.70871 12.93 9.70871 12.555 9.94871 12.315L12.6637 9.58499H3.90371C3.57371 9.58499 3.30371 9.31499 3.30371 8.98499C3.30371 8.65499 3.57371 8.38499 3.90371 8.38499H12.6637L9.94871 5.655C9.70871 5.415 9.70871 5.04 9.94871 4.8C10.1887 4.56 10.5637 4.56 10.8037 4.8L14.5387 8.54999C14.7637 8.80499 14.7637 9.19499 14.5237 9.41999Z" fill="#52BD95" />
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://api.whatsapp.com/send?phone=6281222331598&text=Greetings gorg' human.
You've reached Bertjorak chit-chat space.

Have anything in mind? Just simply ask us any of your curiosity." target="_blank" class="dropdown-hover d-flex align-items-center justify-content-center text-start text-decoration-none">
                                                <img class="" src="http://api.elements.buildwithangga.com/storage/files/2/assets/Header/Header5/Header-5-6.png" alt="" />
                                                <div class="flex-grow-1 ps-4">
                                                    <h2 class="icon-item-title">
                                                        Ask your quesaations
                                                    </h2>
                                                    <p class="icon-item-caption" style="margin-bottom: 0">
                                                        Ask us about a complaint
                                                    </p>
                                                </div>
                                                <svg class="dropdown-icon-arrow d-none" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14.5237 9.41999L10.7887 13.17C10.6687 13.29 10.5187 13.35 10.3687 13.35C10.2187 13.35 10.0687 13.29 9.94871 13.17C9.70871 12.93 9.70871 12.555 9.94871 12.315L12.6637 9.58499H3.90371C3.57371 9.58499 3.30371 9.31499 3.30371 8.98499C3.30371 8.65499 3.57371 8.38499 3.90371 8.38499H12.6637L9.94871 5.655C9.70871 5.415 9.70871 5.04 9.94871 4.8C10.1887 4.56 10.5637 4.56 10.8037 4.8L14.5387 8.54999C14.7637 8.80499 14.7637 9.19499 14.5237 9.41999Z" fill="#52BD95" />
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="#">Reviews</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/about') }}">About</a>
                                </li>
                            </ul>
                        </div>

                        <div class="modal-footer me-auto" style="padding: 2rem; padding-top: 0.75rem">

                            @auth
                            {{-- Buyer --}}
                            @if (Auth::user()->hasRole('coffeshop'))
                            @if (Auth::user()->avatar != null)
                            <a class="nav-link " href="{{ route('dashboard.index') }}" data-bs-toggle="dropdown">
                                <img src="{{ asset('/storage/account/' . Auth::user()->id . '/avatar/' . Auth::user()->avatar) }}" class="me-2 rounded-full" alt="icon-user" width="45" height="45">
                                {{ Auth::user()->name }}
                            </a>
                            @else
                            <a class="nav-link " href="{{ route('dashboard.index') }}" data-bs-toggle="dropdown">
                                <img src="{{ asset('assets/images/blank-profile-picture.png') }}" class="me-2 rounded-full" alt="icon-user" width="45" height="45">
                                {{ Auth::user()->name }}
                            </a>
                            @endif
                            <a class="nav-link" href="{{ route('cart.index') }}">
                                <img src="{{ asset('frontend/images/icon-cart.svg') }}" alt="" />
                                <div class="cart-icon">
                                    <livewire:cart.count-cart />
                                </div>
                            </a>
                            {{-- Admin --}}
                            @else
                            <a href="{{ route('dashboard.index') }}">
                                <button type="button" class="btn btn-primary">
                                    Dashboard
                                </button>
                            </a>
                            @endif
                            {{-- Belum Login --}}
                            @else
                            <a href="/login" class="btn btn-fill text-white me-2">Login</a>
                            <a href="/register" class="btn btn-register">Register</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo">
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                    <li class="nav-item me-2">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item me-2 dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">Products
                            <svg class="ms-2 d-lg-block dropdown-icon-drop" width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 1L4.5 5L1 1" stroke="#1D2B4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <svg class="ms-2 d-lg-none dropdown-icon-close" width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 1L4.5 5L1 1" stroke="#7F31FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M1 9L4.5 5L8 9" stroke="#7F31FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu" style="cursor: pointer">

                            <li>
                                <a href="{{ route('all-product') }}" class="dropdown-hover d-flex align-items-center justify-content-center text-start text-decoration-none">
                                    <img class="" src="http://api.elements.buildwithangga.com/storage/files/2/assets/Header/Header5/Header-5-5.png" alt="" />
                                    <div class="flex-grow-1 ps-4">
                                        <h2 class="icon-item-title">Our product</h2>
                                        <p class="icon-item-caption" style="margin-bottom: 0">
                                            Let's see our product
                                        </p>
                                    </div>
                                    <svg class="dropdown-icon-arrow d-none" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.5237 9.41999L10.7887 13.17C10.6687 13.29 10.5187 13.35 10.3687 13.35C10.2187 13.35 10.0687 13.29 9.94871 13.17C9.70871 12.93 9.70871 12.555 9.94871 12.315L12.6637 9.58499H3.90371C3.57371 9.58499 3.30371 9.31499 3.30371 8.98499C3.30371 8.65499 3.57371 8.38499 3.90371 8.38499H12.6637L9.94871 5.655C9.70871 5.415 9.70871 5.04 9.94871 4.8C10.1887 4.56 10.5637 4.56 10.8037 4.8L14.5387 8.54999C14.7637 8.80499 14.7637 9.19499 14.5237 9.41999Z" fill="#7F31FF" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="https://api.whatsapp.com/send?phone=6281222331598&text=Greetings gorg' human.
You've reached Bertjorak chit-chat space.

Have anything in mind? Just simply ask us any of your curiosity." target="_blank" class="dropdown-hover d-flex align-items-center justify-content-center text-start text-decoration-none">
                                    <img class="" src="http://api.elements.buildwithangga.com/storage/files/2/assets/Header/Header5/Header-5-6.png" alt="" />
                                    <div class="flex-grow-1 ps-4">
                                        <h2 class="icon-item-title">Ask your questions</h2>
                                        <p class="icon-item-caption" style="margin-bottom: 0">
                                            Ask us about a complaint
                                        </p>
                                    </div>
                                    <svg class="dropdown-icon-arrow d-none" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.5237 9.41999L10.7887 13.17C10.6687 13.29 10.5187 13.35 10.3687 13.35C10.2187 13.35 10.0687 13.29 9.94871 13.17C9.70871 12.93 9.70871 12.555 9.94871 12.315L12.6637 9.58499H3.90371C3.57371 9.58499 3.30371 9.31499 3.30371 8.98499C3.30371 8.65499 3.57371 8.38499 3.90371 8.38499H12.6637L9.94871 5.655C9.70871 5.415 9.70871 5.04 9.94871 4.8C10.1887 4.56 10.5637 4.56 10.8037 4.8L14.5387 8.54999C14.7637 8.80499 14.7637 9.19499 14.5237 9.41999Z" fill="#7F31FF" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- <li class="nav-item me-2">
                        <a class="nav-link" href="#">Reviews</a>
                    </li> --}}
                    <li class="nav-item me-2">
                        <a class="nav-link" href="{{ url('/about') }}">About</a>
                    </li>
                </ul>

                @auth
                {{-- Buyer --}}
                @if (Auth::user()->hasRole('coffeshop'))
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item me-2 dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                            @php
                            $convertImg = json_decode(Auth::user()->avatar);
                            @endphp

                            @if ($convertImg == null)
                            <img src="{{ asset('assets/images/blank-profile-picture.png') }}" class="me-2" alt="icon-user" width="45" height="45" style="border-radius: 50%;">
                            @elseif ($convertImg != null)
                            <img src="{{ asset('/storage/account/' . Auth::user()->id . '/avatar/' . $convertImg) }}" class="me-2" alt="icon-user" width="45" height="45" style="border-radius: 50%;">
                            @endif
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" style="cursor: pointer">

                            <li>
                                <a href="{{ route('dashboard.index') }}" class="dropdown-hover d-flex align-items-center justify-content-center text-start text-decoration-none">
                                    <img class="" src="http://api.elements.buildwithangga.com/storage/files/2/assets/Header/Header5/Header-5-5.png" alt="" />
                                    <div class="flex-grow-1 ps-4">
                                        <h2 class="icon-item-title">Dashboard</h2>
                                        <p class="icon-item-caption" style="margin-bottom: 0">
                                            Update your profile
                                        </p>
                                    </div>
                                    <svg class="dropdown-icon-arrow d-none" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.5237 9.41999L10.7887 13.17C10.6687 13.29 10.5187 13.35 10.3687 13.35C10.2187 13.35 10.0687 13.29 9.94871 13.17C9.70871 12.93 9.70871 12.555 9.94871 12.315L12.6637 9.58499H3.90371C3.57371 9.58499 3.30371 9.31499 3.30371 8.98499C3.30371 8.65499 3.57371 8.38499 3.90371 8.38499H12.6637L9.94871 5.655C9.70871 5.415 9.70871 5.04 9.94871 4.8C10.1887 4.56 10.5637 4.56 10.8037 4.8L14.5387 8.54999C14.7637 8.80499 14.7637 9.19499 14.5237 9.41999Z" fill="#7F31FF" />
                                    </svg>
                                </a>
                            </li>

                            {{-- <li>
                                        <a href="{{ route('logout') }}"
                            class="dropdown-hover d-flex align-items-center justify-content-center text-start text-decoration-none">
                            <img class="" src="{{ asset('assets/images/logout-svgrepo-com.svg') }}" alt="" />
                            <div class="flex-grow-1 ps-4">
                                <h2 class="icon-item-title">Logout</h2>
                                <p class="icon-item-caption" style="margin-bottom: 0">
                                    Logout from account
                                </p>
                            </div>
                            <svg class="dropdown-icon-arrow d-none" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.5237 9.41999L10.7887 13.17C10.6687 13.29 10.5187 13.35 10.3687 13.35C10.2187 13.35 10.0687 13.29 9.94871 13.17C9.70871 12.93 9.70871 12.555 9.94871 12.315L12.6637 9.58499H3.90371C3.57371 9.58499 3.30371 9.31499 3.30371 8.98499C3.30371 8.65499 3.57371 8.38499 3.90371 8.38499H12.6637L9.94871 5.655C9.70871 5.415 9.70871 5.04 9.94871 4.8C10.1887 4.56 10.5637 4.56 10.8037 4.8L14.5387 8.54999C14.7637 8.80499 14.7637 9.19499 14.5237 9.41999Z" fill="#7F31FF" />
                            </svg>
                            </a>
                    </li> --}}
                </ul>
                {{-- <a class="nav-link" href="{{ route('cart.index') }}">
                <div class="d-flex">
                    <img src="{{ asset('frontend/images/icon-cart.svg') }}" alt="cart-icon" />
                    <livewire:cart.count-cart />
                </div>
                </a> --}}

                {{-- Admin --}}
                @else
                <a href="{{ route('dashboard.index') }}">
                    <button type="button" class="btn">
                        Dashboard
                    </button>
                </a>
                @endif
                {{-- Belum Login --}}
                @else
                <a href="/login" class="btn btn-fill text-white me-2">Login</a>
                <a href="/register" class="btn btn-register">Register</a>
                @endauth
            </div>
        </nav>
    </div>
</section>
