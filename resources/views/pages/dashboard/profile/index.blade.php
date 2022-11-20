@extends('layouts.app')

@section('title', ' Profile')

@section('content')

    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        My Profile
                    </h2>
                </div>
                <div class="col-span-4 lg:text-right">
                    <div class="relative mt-0 md:mt-6">
                        <a href="{{ route('dashboard.profile.edit', Auth::user()->id) }}"
                            class="inline-block px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-button">
                            Edit My Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <section class="featured bg-noise-texture-1 font-worksans">
                        <style>
                            @import url("https://fonts.googleapis.com/css2?family=Sarala:wght@400;700&family=Work+Sans:wght@400;500;600;700&display=swap");

                            .font-sarala {
                                font-family: 'Sarala', sans-serif;
                            }

                            .font-worksans {
                                font-family: 'Work Sans', sans-serif;
                            }

                            :root {
                                --soft-purple-1: #6558F5;
                                --soft-purple-2: #9392CC;
                                --soft-purple-3: #9D8FFB;
                                --dark-navy: #0D092E;
                                --deepBlue-1: #1F1569;
                                --deepBlue-2: #081537;
                            }

                            .bg-dark-navy {
                                background-color: var(--dark-navy);
                            }

                            .bg-soft-purple-1 {
                                background-color: var(--soft-purple-1);
                            }

                            .text-soft-purple-2 {
                                color: var(--soft-purple-2);
                            }

                            .text-soft-purple-3 {
                                color: var(--soft-purple-3);
                            }

                            .border-borderColor-1 {
                                border-color: #242359;
                            }

                            .border-borderColor-2 {
                                border-color: #5452A5;
                            }

                            .text-40 {
                                font-size: 40px;
                            }

                            .rounded-10 {
                                border-radius: 10px;
                            }

                            .rounded-t-10 {
                                border-top-left-radius: 10px;
                                border-top-right-radius: 10px;
                            }

                            .bg-noise-texture-1 {
                                background-image: url('https://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content-Crypto/noise-texture.png');
                            }

                            .bg-noise-texture-2 {
                                background-image: url('https://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content-Crypto/noise-texture-2.png');
                            }

                            .card-creator {
                                border: 1.5px solid rgba(255, 255, 255, 0.7);
                                background: linear-gradient(180deg, rgba(255, 255, 255, 0.2) 0.55%, rgba(255, 255, 255, 0.06) 99.99%);
                            }

                            .pt-60 {
                                padding-top: 60px;
                            }

                            .w-240 {
                                width: 240px;
                            }

                        </style>
                        <div
                            class="flex flex-col flex-wrap items-start justify-between gap-10 space-y-2 md:flex-row md:gap-0">
                            <!-- card 1 -->
                            <div class="backdrop-filter backdrop-blur-xl rounded-10 bg-white w-full">

                                <!-- card content -->
                                @foreach ($users as $u)
                                    <div class="px-8 rounded-10 card-creator pt-60 pb-10 w-full">
                                        <h5 class="font-semibold text-xl">Personal Information</h5>
                                        <br>
                                        <div class="relative z-10 flex flex-col items-left">
                                            @php
                                                $convertImg = json_decode($u->avatar);
                                            @endphp
                                            @if ($convertImg == null)
                                                <div class="overflow-hidden rounded-full"
                                                    style="background-color: pink; width: 10em; height: 10em;">
                                                    <img src="{{ asset('assets/images/blank-profile-picture.png') }}"
                                                        alt="profile"
                                                        style="width: 100%; height: 100%; object-fit: contain;" />
                                                </div>
                                            @elseif ($convertImg != null)
                                                <div class="overflow-hidden rounded-full"
                                                    style="background-color: pink; width: 10em; height: 10em;">
                                                    <img src="{{ asset('/storage/account/' . Auth::user()->id . '/avatar/' . $convertImg) }}"
                                                        alt="profile"
                                                        style="width: 100%; height: 100%; object-fit: contain;" />
                                                </div>
                                            @endif


                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 ">
                                            <div class="col-span-3 mt-3">
                                                <label class="block mb-3 font-medium text-gray-700 text-md">Email
                                                    Address</label>
                                                <div class="block w-full mt-1 sm:text-sm">
                                                    {{ $u->email }}
                                                </div>
                                            </div>

                                            <div class="col-span-3 mt-3">
                                                <label for="name"
                                                    class="block mb-3 font-medium text-gray-700 text-md">Name</label>
                                                <div class="block w-full mt-1 sm:text-sm">
                                                    {{ $u->name }}
                                                </div>
                                            </div>
                                            <div class="col-span-3 mt-3">
                                                <label class="block mb-3 font-medium text-gray-700 text-md">Username</label>
                                                <div class="block w-full mt-1 sm:text-sm">
                                                    @if ($u->username != null)
                                                        {{ '@' . $u->username }}
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-span-3 mt-3">
                                                <label for="name"
                                                    class="block mb-3 font-medium text-gray-700 text-md">Contact
                                                    Number</label>
                                                <div class="block w-full mt-1 sm:text-sm">
                                                    @if ($u->phone_number != null)
                                                        {{ $u->phone_number }}
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </div>

                                            {{-- @php
                                                $dd = json_decode($userProv);
                                                dd($dd->id_province);
                                                // foreach ($userProv as $keyProv) {
                                                //     $prov = $keyProv;
                                                //     dd($prov);
                                                // }
                                            @endphp --}}

                                            <div class="col-span-3 mt-3">
                                                <label for="name" class="block mb-3 font-medium text-gray-700 text-md">Label
                                                    Address</label>
                                                <div class="block w-full mt-1 sm:text-sm">
                                                    @if ($u->type_address != null)
                                                        {{ $u->type_address }}
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </div>

                                            @php
                                                // Get Province
                                                $getProv = $userProv->where('province_id', $u->id_province);
                                                foreach ($getProv as $keyProv) {
                                                    $valProv = $keyProv->name_province;
                                                }
                                                
                                                // Get City
                                                $getCity = $userCity->where('city_id', $u->id_city);
                                                foreach ($getCity as $keyCity) {
                                                    // Type City
                                                    $valTypeCity = $keyCity->type;
                                                
                                                    // Name City
                                                    $valCity = $keyCity->name_city;
                                                }
                                            @endphp
                                            <div class="col-span-3 mt-3">
                                                <label for="name"
                                                    class="block mb-3 font-medium text-gray-700 text-md">Province</label>
                                                <div class="block w-full mt-1 sm:text-sm">
                                                    @if ($u->id_province != null)
                                                        {{ $valProv }}
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-span-3 mt-3">
                                                <label for="name"
                                                    class="block mb-3 font-medium text-gray-700 text-md">City</label>
                                                <div class="block w-full mt-1 sm:text-sm">
                                                    @if ($u->id_city != null)
                                                        {{ $valTypeCity . ' ' . $valCity }}
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-span-3 mt-3">
                                                <label for="name"
                                                    class="block mb-3 font-medium text-gray-700 text-md">Postal
                                                    Code</label>
                                                <div class="block w-full mt-1 sm:text-sm">
                                                    @if ($u->zipcode != null)
                                                        {{ $u->zipcode }}
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </div>



                                        </div>

                                        <div class="col-span-3 mt-3">
                                            <label for="name" class="block mb-3 font-medium text-gray-700 text-md">Detail
                                                Address</label>
                                            <div class="block w-full mt-1 sm:text-sm text-justify">
                                                @if ($u->detail_address != null)
                                                    {{ $u->detail_address }}
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach



                            </div> <!-- card 2 -->

                        </div>
                    </section>

                </main>
            </div>
        </section>
    </main>

    {{-- <div class="flex h-screen">
        <div class="m-auto text-center">
            <img src="{{ asset('/assets/images/empty-illustration.svg') }}" alt="" class="w-48 mx-auto">
            <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                There is No Requests Yet
            </h2>
            <p class="text-sm text-gray-400">
                It seems that you haven’t provided any service. <br>
                Let’s create your first service!
            </p>

            <div class="relative mt-0 md:mt-6">
                <a href="#" class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-button">
                    + Add Services
                </a>
            </div>
        </div>
    </div> --}}

@endsection
