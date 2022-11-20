<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 overflow-y-auto bg-white md:hidden" x-show="isSideMenuOpen"
    x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu" aria-label="aside">
    <div class="py-4 text-gray-500 dark:text-gray-400">

        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="{{ URL('/') }}">
            <img src="{{ asset('frontend/images/main-logo.png') }}" alt="" style="width: 35%;" class="ml-6">
        </a>

        <div class="flex items-center pt-5 pl-5 mt-10 space-x-2 border-t border-gray-100">
            @php
                $convertImg = json_decode(Auth::user()->avatar);
            @endphp
            <!--Author's profile photo-->
            @if ($convertImg == null)
                <img class="object-cover object-center mr-1 rounded-full w-14 h-14"
                    src="{{ asset('assets/images/blank-profile-picture.png') }}" alt="random user" />
            @else
                <img class="object-cover object-center mr-1 rounded-full w-14 h-14"
                    src="{{ asset('/storage/account/' . Auth::user()->id . '/avatar/' . $convertImg) }}"
                    alt="random user" />
            @endif
            <div>
                <!--Author name-->
                <p class="font-semibold text-gray-900 text-md">{{ Auth::user()->name }}</p>
                <p class="text-sm font-light text-serv-text">
                    {{ '@' . Auth::user()->username }}
                </p>
            </div>
        </div>

        {{-- Dashboard Nav --}}
        <ul class="mt-6">
            <li class="relative px-6 py-3">

                @if (request()->is('dashboard'))
                    <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                        aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-medium transition-colors duration-150 hover:text-gray-800 "
                        href="{{ route('dashboard.index') }}">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M19.5 16V9.02123C19.5 7.75027 18.896 6.55494 17.8728 5.80101L12.3728 1.74838C10.9618 0.708674 9.03823 0.708675 7.6272 1.74838L2.1272 5.80101C1.10401 6.55494 0.5 7.75027 0.5 9.02123V16C0.5 18.2091 2.29086 20 4.5 20H5.75C6.57843 20 7.25 19.3284 7.25 18.5V16C7.25 15.1716 7.92157 14.5 8.75 14.5H11.25C12.0784 14.5 12.75 15.1716 12.75 16V18.5C12.75 19.3284 13.4216 20 14.25 20H15.5C17.7091 20 19.5 18.2091 19.5 16Z"
                                fill="#082431" />
                        </svg>
                        <span class="ml-4">Dashboard</span>
                    </a>
                @else
                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('dashboard.index') }}">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M19.5 16V9.02123C19.5 7.75027 18.896 6.55494 17.8728 5.80101L12.3728 1.74838C10.9618 0.708674 9.03823 0.708675 7.6272 1.74838L2.1272 5.80101C1.10401 6.55494 0.5 7.75027 0.5 9.02123V16C0.5 18.2091 2.29086 20 4.5 20H5.75C6.57843 20 7.25 19.3284 7.25 18.5V16C7.25 15.1716 7.92157 14.5 8.75 14.5H11.25C12.0784 14.5 12.75 15.1716 12.75 16V18.5C12.75 19.3284 13.4216 20 14.25 20H15.5C17.7091 20 19.5 18.2091 19.5 16Z"
                                fill="#082431" />
                        </svg>
                        <span class="ml-4">Dashboard</span>
                    </a>
                @endif
            </li>
        </ul>

        <ul>
            {{-- Profile Nav --}}
            <li class="relative px-6 py-3">

                @if (request()->is('dashboard/profile') || request()->is('dashboard/profile/*') || request()->is('dashboard/*/profile') || request()->is('dashboard/*/profile/*'))
                    <a class="inline-flex items-center w-full text-sm font-medium transition-colors duration-150 hover:text-gray-800 "
                        href="{{ route('dashboard.profile.index') }}">


                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                        <!-- Active Icons -->

                        <svg width="24" height="24" viewBox="0 0 24 24" fill="#082431"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect width="24" height="24" fill="white" />
                            <circle cx="10.5" cy="5.5" r="2.75" stroke="#082431" stroke-width="1.5" />
                            <path
                                d="M3.75 18.2581C3.75 14.6638 6.66376 11.75 10.2581 11.75H11.7419C15.3362 11.75 18.25 14.6638 18.25 18.2581C18.25 18.8059 17.8059 19.25 17.2581 19.25H4.74194C4.1941 19.25 3.75 18.8059 3.75 18.2581Z"
                                stroke="#082431" stroke-width="1.5" />
                            <path
                                d="M17.75 14.299C18.1642 13.5816 19.0816 13.3358 19.799 13.75C20.5165 14.1642 20.7623 15.0816 20.3481 15.799L19.5981 17.0981L17.9314 19.9848C17.715 20.3596 17.383 20.6541 16.985 20.8241L15.4217 21.4919C15.3603 21.518 15.2911 21.478 15.2831 21.4119L15.0797 19.7241C15.028 19.2944 15.117 18.8596 15.3333 18.4848L17 15.5981L17.75 14.299Z"
                                fill="#082431" />
                            <path
                                d="M17 15.5981L15.3333 18.4848C15.117 18.8596 15.028 19.2944 15.0797 19.7241L15.2831 21.4119C15.2911 21.478 15.3603 21.518 15.4217 21.4919L16.985 20.8241C17.383 20.6541 17.715 20.3596 17.9314 19.9848L19.5981 17.0981M17 15.5981L17.75 14.299C18.1642 13.5816 19.0816 13.3358 19.799 13.75V13.75C20.5165 14.1642 20.7623 15.0816 20.3481 15.799L19.5981 17.0981M17 15.5981L19.5981 17.0981"
                                stroke="#082431" stroke-width="1.5" />
                        </svg>

                        <span class="ml-4">Profile</span>
                        {{-- <span class="inline-flex items-center justify-center px-3 py-2 ml-auto text-xs font-bold leading-none text-green-500 rounded-full bg-serv-green-badge">
                        {{ auth()->user()->order_buyer()->count() }}
                    </span> --}}

                    </a>
                @else
                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('dashboard.profile.index') }}">

                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="24" height="24" fill="white" />
                            <circle cx="10.5" cy="5.5" r="2.75" stroke="#082431" stroke-width="1.5" />
                            <path
                                d="M3.75 18.2581C3.75 14.6638 6.66376 11.75 10.2581 11.75H11.7419C15.3362 11.75 18.25 14.6638 18.25 18.2581C18.25 18.8059 17.8059 19.25 17.2581 19.25H4.74194C4.1941 19.25 3.75 18.8059 3.75 18.2581Z"
                                stroke="#082431" stroke-width="1.5" />
                            <path
                                d="M17.75 14.299C18.1642 13.5816 19.0816 13.3358 19.799 13.75C20.5165 14.1642 20.7623 15.0816 20.3481 15.799L19.5981 17.0981L17.9314 19.9848C17.715 20.3596 17.383 20.6541 16.985 20.8241L15.4217 21.4919C15.3603 21.518 15.2911 21.478 15.2831 21.4119L15.0797 19.7241C15.028 19.2944 15.117 18.8596 15.3333 18.4848L17 15.5981L17.75 14.299Z"
                                fill="white" />
                            <path
                                d="M17 15.5981L15.3333 18.4848C15.117 18.8596 15.028 19.2944 15.0797 19.7241L15.2831 21.4119C15.2911 21.478 15.3603 21.518 15.4217 21.4919L16.985 20.8241C17.383 20.6541 17.715 20.3596 17.9314 19.9848L19.5981 17.0981M17 15.5981L17.75 14.299C18.1642 13.5816 19.0816 13.3358 19.799 13.75V13.75C20.5165 14.1642 20.7623 15.0816 20.3481 15.799L19.5981 17.0981M17 15.5981L19.5981 17.0981"
                                stroke="#082431" stroke-width="1.5" />
                        </svg>

                        <span class="ml-4">Profile</span>
                        {{-- <span class="inline-flex items-center justify-center px-3 py-2 ml-auto text-xs font-bold leading-none text-green-500 rounded-full bg-serv-green-badge">
                            {{ auth()->user()->order_buyer()->count() }}
                        </span> --}}

                    </a>
                @endif
            </li>

            {{-- Product Nav --}}
            @if (Auth::user()->hasRole('admin'))
                <li class="relative px-6 py-3">

                    @if (request()->is('dashboard/product') || request()->is('dashboard/product/*') || request()->is('dashboard/*/product') || request()->is('dashboard/*/product/*'))
                        <a class="inline-flex items-center w-full text-sm font-medium transition-colors duration-150 hover:text-gray-800 "
                            href="{{ route('dashboard.product.index') }}">


                            <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                                aria-hidden="true"></span>
                            <!-- Active Icons -->
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="2.25" y="1.25" width="19.5" height="21.5" rx="4.75" fill="#082431"
                                    stroke="#082431" stroke-width="1.5" />
                                <rect x="11" y="7" width="2" height="10" rx="1" fill="white" />
                                <rect x="17" y="11" width="2" height="10" rx="1" transform="rotate(90 17 11)"
                                    fill="white" />
                            </svg>

                            <span class="ml-4">Product</span>
                            {{-- <span class="inline-flex items-center justify-center px-3 py-2 ml-auto text-xs font-bold leading-none text-green-500 rounded-full bg-serv-green-badge">
                        {{ auth()->user()->order_buyer()->count() }}
                    </span> --}}

                        </a>
                    @else
                        <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                            href="{{ route('dashboard.product.index') }}">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="2.25" y="1.25" width="19.5" height="21.5" rx="4.75" stroke="#082431"
                                    stroke-width="1.5" />
                                <rect x="11.3" y="7" width="1.4" height="10" rx="0.7" fill="#082431" />
                                <rect x="17" y="11" width="1.4" height="10" rx="0.7" transform="rotate(90 17 11)"
                                    fill="#082431" />
                            </svg>

                            <span class="ml-4">Product</span>
                            {{-- <span class="inline-flex items-center justify-center px-3 py-2 ml-auto text-xs font-bold leading-none text-green-500 rounded-full bg-serv-green-badge">
                            {{ auth()->user()->order_buyer()->count() }}
                        </span> --}}

                        </a>
                    @endif
                </li>
            @endif

            {{-- Report Nav --}}
            @if (Auth::user()->hasRole('admin'))
                <li class="relative px-6 py-3">

                    @if (request()->is('dashboard/laporan') || request()->is('dashboard/laporan/*') || request()->is('dashboard/*/laporan') || request()->is('dashboard/*/laporan/*'))
                        <a class="inline-flex items-center w-full text-sm font-medium transition-colors duration-150 hover:text-gray-800 "
                            href="{{ route('dashboard.laporan.index') }}">


                            <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                                aria-hidden="true"></span>
                            <!-- Active Icons -->
                            <img
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAACZ0lEQVRIibXU32sWZBQH8E8zGJEXKqaJNbfB1q5iCkFXokU/CAJBL9SLUMwCG4gyvZHS/gK90BsbQdBFmasgDBF1OhpaY2BTmzImOGwzdaWVYE57vXjOuz2+e7fmKx14OM8553nOec75nufwP9MTwWvwNg5gCZor9NeN4+UMP6CAg1gT+0rWfdTmjquCLwh+DnMqfD3cwF+5oliiASm91ajH7AqcF9A/VYAaDFbguEhL8Wup8smSfX0mt2FkGo4X4/USX2NUVU45Ddu0z+VR/0BPJtfEKkfNmBv7TrTgermDOQZXsHfqx47Ru1iGjfgFm9CIa/gCX0mgj9GA/+7xEdzN5Basw72Qc9tn2ePLBhiI1IvyDczDlsxejzshD6IOh7I770wW4DZeQjV2SL+7ATtxNc7sw7bszlZ8hNZMd5SJHdCNV7AcfdKnWYVdsebHud/xbHZvJb7Gv5luQWmAAt6U+roVt7AHl7AWH6IrztZG1kXqwQp0ZLr+ciX6DaPSVH0vdO8HX49vjGNSG7zYAMvwc1aiN8qVaDt6S3QHTKSZeFrCqCANyA68GPYvxdieEYrNUr13SyBfkDAYlTrjGRwLZ6/h87B9INX9tDQgj+C5qMRbaM8/2p/SJ5mKqiUsPpYAP4wNUgN8Ek5/xAvxyIbixSIG/xiv4WT7AvZL2AxJI+Y8/sYZ6W/0SV01hsFPkdbz+BbDkep30gheiO+zTIbRJGHQFcEuSu06JAHcxDgGnZFaL07gFM7GviteeDIut0kA1klDr1EaFy/jJl4NvgifPjQvHpGeksbBrDK2UbTj8mP4nx49ADvo0Ewaou1KAAAAAElFTkSuQmCC" />

                            <span class="ml-4">Reports</span>
                        </a>
                    @else
                        <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                            href="{{ route('dashboard.laporan.index') }}">

                            <img
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAACcklEQVRIibXVXWjXZRQH8M98DdF0GssE3zO1XFFmkIiI3uiFd06vTBCKhqgY+HIVBkPC6mIIelGQN6HohV2FojK9URhzIr4MjenabEOhRtpFGWUX5/zd31/7O53twMNznvM7z/k+5/XHEFNV7i+jEQsx7Dns/YavcaD44RC2YApOYT2qB7GmoRnvlwyPyP1dfIjf0YRX0DsID3pxGvNwvhxgGP7BcmzDQXw0CIBJWIulJcGIgsLf+Cb5Wc9ofAl+wjL8XAngbK4STcfwAQz/hS7sRnfyj6gIUE5TcBgjBwD4AyvzYRXz1o4xAxgaiPr1tFjzm/HrU6zLooeqsQ93RXhu4zOM/j88mIBLaMCLmIEaUSQnFULbH0ANxpadF4sqmZrnr/B58mtxHyvyfBT1TwIYh060iPJbjZvYhVGp05mPgCtYJ0JMdHJTJYDX0YpPsQbXxIyZX/DwF32zbCM6sDXPk3G1P4AaPMR2zMR4vIQ3Uu9g2Z3LmJP8d9gjQkOU7feVPKgV/dGIujTyQb62u+zOJhxL+UL8KIbdKFxIkH5H85f6GrAKr4r2L9KB1DuVXq7E22KansNx/tvJtXhLDLoFeAF/Ym7KxuAdkaMjmJ0PmJD6V0SuxmIvdpSS1J7G3yu59gRqwgncEWO9S/RAuwjndbwpwlTK0WM5qC4zNjH3qoKcqJJ9ov734h6+EBX3LX6gLwcd4l+wBD0iaXUpnyHK72oZINErLWKatuIBLoqQXijomp9etOETEctborGa81sDzuDjvHNX1HuPKO/bee7Ea2nrMarHzuR3Y0Py+7EqvT2MRSnfhRsJXlxt4r8+9PQvQWeSzkV5g9YAAAAASUVORK5CYII=" />

                            <span class="ml-4">Reports</span>
                        </a>
                    @endif


                </li>
            @endif


            {{-- Transaction Nav --}}
            <li class="relative px-6 py-3">

                @if (request()->is('dashboard/transaction') || request()->is('dashboard/transaction/*') || request()->is('dashboard/*/transaction') || request()->is('dashboard/*/transaction/*'))
                    <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                        aria-hidden="true"></span>

                    <a class="inline-flex items-center w-full text-sm font-medium transition-colors duration-150 hover:text-gray-800 "
                        href="{{ route('dashboard.transaction.index') }}">

                        <!-- Active Icons -->
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="2" width="18" height="20" rx="4" fill="#082431" />
                            <line x1="7.75" y1="7.25" x2="10.25" y2="7.25" stroke="white" stroke-width="1.5"
                                stroke-linecap="round" />
                            <line x1="7.75" y1="11.25" x2="16.25" y2="11.25" stroke="white" stroke-width="1.5"
                                stroke-linecap="round" />
                            <line x1="7.75" y1="15.25" x2="16.25" y2="15.25" stroke="white" stroke-width="1.5"
                                stroke-linecap="round" />
                        </svg>
                        <span class="ml-4">Transaction</span>

                        {{-- <span class="inline-flex items-center justify-center px-3 py-2 ml-auto text-xs font-bold leading-none text-green-500 rounded-full bg-serv-green-badge">
                            {{ auth()->user()->order_freelancer()->count() }}
                        </span> --}}

                    </a>
                @else
                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('dashboard.transaction.index') }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3.25" y="2.25" width="17.5" height="19.5" rx="4.75" stroke="#082431"
                                stroke-width="1.5" />
                            <line x1="7.75" y1="7.25" x2="10.25" y2="7.25" stroke="#082431" stroke-width="1.5"
                                stroke-linecap="round" />
                            <line x1="7.75" y1="11.25" x2="16.25" y2="11.25" stroke="#082431" stroke-width="1.5"
                                stroke-linecap="round" />
                            <line x1="7.75" y1="15.25" x2="16.25" y2="15.25" stroke="#082431" stroke-width="1.5"
                                stroke-linecap="round" />
                        </svg>
                        <span class="ml-4">Transaction</span>
                        {{-- <span class="inline-flex items-center justify-center px-3 py-2 ml-auto text-xs font-bold leading-none text-green-500 rounded-full bg-serv-green-badge">
                            {{ auth()->user()->order_freelancer()->count() }}
                        </span> --}}

                    </a>
                @endif


            </li>

            {{-- Logout Nav --}}
            <li class="relative px-6 py-3">
                <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="24" height="24" fill="white" />
                        <path
                            d="M15 7.5V7C15 4.79086 13.2091 3 11 3H7C4.79086 3 3 4.79086 3 7V17C3 19.2091 4.79086 21 7 21H11C13.2091 21 15 19.2091 15 17V16.5"
                            stroke="#082431" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M18.5 9.5L20.8586 11.8586C20.9367 11.9367 20.9367 12.0633 20.8586 12.1414L18.5 14.5"
                            stroke="#082431" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M9.5 12L20 12" stroke="#082431" stroke-width="1.5" stroke-linecap="round" />
                    </svg>

                    <span class="ml-4">Logout</span>

                    <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                        @csrf
                    </form>

                </a>
            </li>

        </ul>

    </div>
</aside>
