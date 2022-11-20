@extends('layouts.app')

@section('title', ' Edit Profile')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Edit My Profile
                    </h2>
                    <p class="text-sm text-gray-400">
                        Enter your data Correctly & Properly
                    </p>
                </div>
            </div>
        </div>
        <section class="container px-6 mx-auto mt-5">
            @if ($errors->any())
                <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                    @foreach ($errors->all() as $error)
                        <p>{{ '- ' . $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-2 py-2 mt-2 bg-white rounded-xl">
                        @foreach ($editProfile as $edit)
                            <form action="{{ route('dashboard.profile.update', $edit->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="">
                                    <div class="px-4 py-5">
                                        <h1 class="fs-1 fw-bold" style="font-weight: bold; font-size: 1.25rem;">Personal
                                            Information</h1>
                                        <br>
                                        <div class="">
                                            <div class="flex items-center mt-1">
                                                @php
                                                    $convertImg = json_decode($edit->avatar);
                                                @endphp
                                                @if ($convertImg == null)
                                                    <div class="overflow-hidden rounded-full"
                                                        style="background-color: pink; width: 10em; height: 10em;">
                                                        <img src="{{ asset('assets/images/blank-profile-picture.png') }}"
                                                            alt="profile"
                                                            style="width: 100%; height: 100%; object-fit: contain;"
                                                            id="img_display" />
                                                    </div>
                                                @elseif ($convertImg != null)
                                                    <div class="overflow-hidden rounded-full"
                                                        style="background-color: pink; width: 10em; height: 10em;">
                                                        <img src="{{ asset('/storage/account/' . Auth::user()->id . '/avatar/' . $convertImg) }}"
                                                            alt="profile"
                                                            style="width: 100%; height: 100%; object-fit: contain;"
                                                            id="img_display" />
                                                    </div>
                                                @endif


                                            </div>
                                            <input type="file" accept="image/*" name="avatar" id="avatar"
                                                class="py-4" onchange="loadFile(event)">
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 ">


                                            <div class="col-span-3">
                                                <label class="block mb-3 font-medium text-gray-700 text-md">Email
                                                    Address</label>
                                                <input value="{{ Auth::user()->email }}" type="text"
                                                    class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                    style="background-color : #e0dbdb;" disabled>
                                            </div>

                                            <div class="col-span-3">
                                                <label for="name"
                                                    class="block mb-3 font-medium text-gray-700 text-md">Name</label>
                                                <input value="{{ Auth::user()->name }}" type="text" name="name" id="name"
                                                    autocomplete="name"
                                                    class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            </div>

                                            <div class="col-span-3">
                                                <label for="username"
                                                    class="block mb-3 font-medium text-gray-700 text-md">Username</label>
                                                @if (Auth::user()->username == null)
                                                    <input placeholder="johnsmith" type="text" name="username" id="username"
                                                        autocomplete="username"
                                                        class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                @elseif (Auth::user()->username != null)
                                                    <input value="{{ Auth::user()->username }}" type="text"
                                                        name="username" id="username" autocomplete="username"
                                                        class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                @endif
                                            </div>

                                            <div class="col-span-3">
                                                <label for="phoneNumber"
                                                    class="block mb-3 font-medium text-gray-700 text-md">Contact
                                                    Number</label>
                                                @if (Auth::user()->phone_number == null)
                                                    <input placeholder="087721205555" type="number" name="phoneNumber"
                                                        id="phoneNumber" autocomplete="phoneNumber"
                                                        class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                @elseif (Auth::user()->phone_number != null)
                                                    <input value="{{ Auth::user()->phone_number }}" type="number"
                                                        name="phoneNumber" id="phoneNumber" autocomplete="phoneNumber"
                                                        class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                @endif
                                            </div>
                                        </div>
                                        {{-- @php
                                            dd($edit->id_province);
                                        @endphp --}}
                                        <livewire:address.create :edit_data="$edit" edit_id="{{ $editProfile }}" />

                                    </div>
                                    <div class="px-4 py-3 text-right sm:px-6">
                                        <a href="{{ route('dashboard.profile.index') }}"
                                            class="inline-flex justify-center px-4 py-2 mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                                            Back
                                        </a>
                                        <button type="submit"
                                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </main>
            </div>
        </section>
    </main>

    <script>
        var loadFile = function(event) {
            var img_display = document.getElementById('img_display');
            img_display.src = URL.createObjectURL(event.target.files[0]);
            img_display.onload = function() {
                URL.revokeObjectURL(img_display.src) // free memory
            }
        };
    </script>

@endsection
