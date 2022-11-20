@extends('layouts.front')

@section('title', ' Home')

@section('content')

    {{-- Navigation bar --}}
    @include('includes.Frontend.navbar')


    <section class="bertjorak-header position-relative overflow-hidden">
        <!-- HEADER BACKGROUND -->
        <div class="header-background container-xxl position-relative d-none d-md-block">
            <img src="{{ url('https://api.elements.buildwithangga.com/storage/files/2/assets/Header/Header-Talent-2/header-ornament.png') }}"
                alt="bg-header" class="position-absolute">
        </div>
        <main class="container">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div class="headline">
                    The New Perspective of You
                </div>
                <div class="mt-3 header-description">
                    <p class="text-center">
                        GetShayna is a 100% free resource for companies looking to find
                        remote talent across the globe. No fees, no markups, no middlemen.
                    </p>
                </div>
                <div>
                    <a href="#" class="btn btn-join"> Join ReadyTal </a>
                </div>
                <div class="statistic-text">
                    Over 1,500+ trusted partner around the world
                </div>
                <div class="flex-row flex-wrap partner-logo d-flex justify-content-center align-items-baseline">
                    <div class="mx-4 my-3">smartoro</div>
                    <div class="mx-4 my-3">geoapp</div>
                    <div class="mx-4 my-3">cesis</div>
                    <div class="mx-4 my-3">adelfox</div>
                    <div class="mx-4 my-3">rainbow</div>
                    <div class="mx-4 my-3">simbadda</div>
                </div>
            </div>
        </main>
    </section>

    <section class="h-100 w-100" style="box-sizing: border-box;
                                                    background-image: url('http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content8/Content-8-3.png');
                                                    background-color: #081b21;
                                                    background-repeat: no-repeat;
                                                    background-position: top;
                                                    background-size: contain;
                                                ">

        <div class="content-8-2" style="font-family: 'Inter', sans-serif">
            <div class="main">
                <div class="container-xxl p-0 mx-auto mb-5">
                    <h2 class="text-white title-font">Our special portfolio</h2>
                    <p class="text-white caption-font">
                        This is our portfolio when working on a<br class="d-sm-block d-none" />
                        project from a client.
                    </p>
                </div>
                <div class="container-xxl p-0 mx-auto bg-white">
                    <div class="main-carousel d-flex flex-column">
                        <div id="owl-content-8-2" class="owl-carousel owl-theme mb-11">
                            <div class="item">
                                <img id="1" class="mb-4"
                                    src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content8/Content-8-4.png"
                                    alt="" />
                                <h3 class="title-carousel text-black-1">BOOK PLANNER</h3>
                                <p class="caption-carousel text-black-1">
                                    Simple book design, we are not just design, but<br class="d-xl-block d-none" />
                                    we are too how to marketing this book. ...,
                                    <a href="" class="text-yellow-1">See All</a>
                                </p>
                            </div>
                            <div class="item">
                                <img id="2" class="mb-4"
                                    src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content8/Content-8-5.png"
                                    alt="" />
                                <h3 class="title-carousel text-black-1">
                                    COCOOIL PRODUCT DESIGN
                                </h3>
                                <p class="caption-carousel text-black-1">
                                    Lovely cocooil product, we are not just design,<br class="d-xl-block d-none" />
                                    but we are too how to marketing this....,
                                    <a href="" class="text-yellow-1">See All</a>
                                </p>
                            </div>
                            <div class="item">
                                <img id="3" class="mb-4"
                                    src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content8/Content-8-6.png"
                                    alt="" />
                                <h3 class="title-carousel text-black-1">
                                    RESTAURANT WEB DESIGN
                                </h3>
                                <p class="caption-carousel text-black-1">
                                    Amazing design web, we are not just design, but<br class="d-xl-block d-none" />
                                    we are too how to solve problem...,
                                    <a href="" class="text-yellow-1">See All</a>
                                </p>
                            </div>
                            <div class="item">
                                <img id="4" class="mb-4"
                                    src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content8/Content-8-7.png"
                                    alt="" />
                                <h3 class="title-carousel text-black-1">Curology Oil</h3>
                                <p class="caption-carousel text-black-1">
                                    Lovely cocooil product, we are not just design,<br class="d-xl-block d-none" />
                                    but we are too how to marketing this....,
                                    <a href="" class="text-yellow-1">See All</a>
                                </p>
                            </div>
                            <!-- Blank slide for disabled navigation -->
                            <div class="item"></div>
                        </div>
                        <div class="button-arrow d-flex ms-auto gap-5">
                            <button disabled id="prev-slide" class="btn p-1">
                                <svg width="32" height="33" viewBox="0 0 32 33" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M15.0573 5.98513C15.578 5.46443 16.4222 5.46443 16.9429 5.98513C17.4636 6.50583 17.4636 7.35005 16.9429 7.87075L9.8857 14.9279H25.3334C26.0698 14.9279 26.6667 15.5249 26.6667 16.2613C26.6667 16.9977 26.0698 17.5946 25.3334 17.5946H9.8857L16.9429 24.6518C17.4636 25.1725 17.4636 26.0167 16.9429 26.5374C16.4222 27.0581 15.578 27.0581 15.0573 26.5374L5.72394 17.2041C5.20324 16.6834 5.20324 15.8392 5.72394 15.3185L15.0573 5.98513Z"
                                        fill="#121212" fill-opacity="0.5" />
                                </svg>
                            </button>
                            <button id="next-slide" class="btn p-1">
                                <svg width="32" height="33" viewBox="0 0 32 33" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M16.9427 5.98513C16.422 5.46443 15.5778 5.46443 15.0571 5.98513C14.5364 6.50583 14.5364 7.35005 15.0571 7.87075L22.1143 14.9279H6.66659C5.93021 14.9279 5.33325 15.5249 5.33325 16.2613C5.33325 16.9977 5.93021 17.5946 6.66659 17.5946H22.1143L15.0571 24.6518C14.5364 25.1725 14.5364 26.0167 15.0571 26.5374C15.5778 27.0581 16.422 27.0581 16.9427 26.5374L26.2761 17.2041C26.7968 16.6834 26.7968 15.8392 26.2761 15.3185L16.9427 5.98513Z"
                                        fill="#121212" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    @include('includes.Frontend.footer')
@endsection
