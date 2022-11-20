@extends('layouts.app')

@section('title', ' Detail Order')

@section('content')

    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        My Services
                    </h2>
                    <p class="text-sm text-gray-400">
                        3 Total Services
                    </p>
                </div>

            </div>
        </div>
        <!-- breadcrumb -->
        <nav class="mx-10 mt-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex p-0 list-none">
                <li class="flex items-center">
                    <a href="#" class="text-gray-400">My Services</a>
                    <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li class="flex items-center">
                    <a href="#" class="font-medium">Details Service</a>
                </li>
            </ol>
        </nav>
        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="bg-white rounded-xl">
                        <section class="pt-6 pb-20 mx-8 w-auth">
                            <div class="grid gap-5 md:grid-cols-12">
                                <main class="p-lg-4 p-1 lg:col-span-7 md:col-span-12">
                                    <span
                                        class="inline-flex items-center justify-center px-3 py-2 mb-4 mr-2 text-xs leading-none text-green-500 rounded-full bg-serv-green-badge">Success</span>

                                    <!-- details heading -->
                                    <div class="details-heading">
                                        <h1 class="text-2xl font-semibold">Nama Product</h1>
                                    </div>
                                    <div class="p-3 my-4 bg-gray-100 rounded-lg image-gallery" x-data="gallery()">
                                        <img :src="featured" alt="" class="rounded-lg cursor-pointer w-100"
                                            data-lity>
                                        <div class="flex overflow-x-scroll hide-scroll-bar dragscroll">
                                            <div class="flex mt-2 flex-nowrap">
                                                <img :class="{ 'border-4 border-serv-button': active === 1 }"
                                                    @click="changeThumbnail('https://source.unsplash.com/_SgRNwAVNKw/1600x900/',1)"
                                                    src="https://source.unsplash.com/_SgRNwAVNKw/250x160/" alt=""
                                                    class="inline-block w-24 mr-2 rounded-lg cursor-pointer">
                                                <img :class="{ 'border-4 border-serv-button': active === 2 }"
                                                    @click="changeThumbnail('https://source.unsplash.com/GXNo-OJynTQ/1600x900/',2)"
                                                    src="https://source.unsplash.com/GXNo-OJynTQ/250x160/" alt=""
                                                    class="inline-block w-24 mr-2 rounded-lg cursor-pointer">
                                                <img :class="{ 'border-4 border-serv-button': active === 3 }"
                                                    @click="changeThumbnail('https://source.unsplash.com/x-HpilsdKEk/1600x900/',3)"
                                                    src="https://source.unsplash.com/x-HpilsdKEk/250x160/" alt=""
                                                    class="inline-block w-24 mr-2 rounded-lg cursor-pointer">
                                                <img :class="{ 'border-4 border-serv-button': active === 4 }"
                                                    @click="changeThumbnail('https://source.unsplash.com/hLit2zL-Dhk/1600x900/',4)"
                                                    src="https://source.unsplash.com/hLit2zL-Dhk/250x160/" alt=""
                                                    class="inline-block w-24 mr-2 rounded-lg cursor-pointer">
                                                <img :class="{ 'border-4 border-serv-button': active === 5 }"
                                                    @click="changeThumbnail('https://source.unsplash.com/i1VQZsU86ok/1600x900/',5)"
                                                    src="https://source.unsplash.com/i1VQZsU86ok/250x160/" alt=""
                                                    class="inline-block w-24 mr-2 rounded-lg cursor-pointer">
                                                <img :class="{ 'border-4 border-serv-button': active === 6 }"
                                                    @click="changeThumbnail('https://source.unsplash.com/iEiUITs149M/1600x900/',6)"
                                                    src="https://source.unsplash.com/iEiUITs149M/250x160/" alt=""
                                                    class="inline-block w-24 mr-2 rounded-lg cursor-pointer">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <div>
                                            <!-- The tabs content -->
                                            <div class="leading-8 text-md">
                                                <h2 class="text-xl font-semibold">About This <span
                                                        class="text-serv-button">Product</span></h2>
                                                <div class="mt-4 mb-8 content-description">
                                                    <p>
                                                        Decscription
                                                    </p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </main>
                                <aside class="p-1 lg:p-4 lg:col-span-5 md:col-span-12 md:pt-0">
                                    <div class="mb-4 rounded-lg border-serv-testimonial-border">
                                        <div
                                            class="flex items-center px-2 py-3 mx-4 mt-4 border rounded-full border-serv-testimonial-border">
                                            <div class="flex-1 text-sm font-medium text-center">
                                                <svg class="inline" width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="12" cy="12" r="8" stroke="#082431" stroke-width="1.5" />
                                                    <path d="M12 7V12L15 13.5" stroke="#082431" stroke-width="1.5"
                                                        stroke-linecap="round" />
                                                </svg>
                                                7 Days Delivery
                                            </div>
                                            <div class="flex-1 text-sm font-medium text-center">
                                                <svg class="inline" width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="24" height="24" fill="white" />
                                                    <path
                                                        d="M19 13C19 15 19 18.5 14.6552 18.5C9.63448 18.5 6.12644 18.5 5 18.5"
                                                        stroke="#082431" stroke-width="1.5" stroke-linecap="round" />
                                                    <path d="M4 11.5C4 9.5 4 6 8.34483 6C13.2455 6 16.8724 6 18 6"
                                                        stroke="#082431" stroke-width="1.5" stroke-linecap="round" />
                                                    <path
                                                        d="M7 21.5L4.14142 18.6414C4.06332 18.5633 4.06332 18.4247 4.14142 18.3586L7 15.5"
                                                        stroke="#082431" stroke-width="1.5" stroke-linecap="round" />
                                                    <path
                                                        d="M16 3L18.8586 5.85858C18.9247 5.92468 18.9247 6.06332 18.8586 6.14142L16 9"
                                                        stroke="#082431" stroke-width="1.5" stroke-linecap="round" />
                                                </svg>
                                                1 Revision Limit
                                            </div>
                                        </div>
                                        <div class=" pt-4 pb-2 features-list">
                                            <table class="w-full mb-2">
                                                <tr>
                                                    <td class="text-sm text-serv-text">
                                                        Customer Name
                                                    </td>
                                                    <td class="mb-4 text-sm font-semibold text-right text-black">
                                                        Nama Penerima
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="text-sm text-serv-text">
                                                        Size Baju
                                                    </td>
                                                    <td class="mb-4 text-sm font-semibold text-right text-black">
                                                        XL
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="text-sm leading-7 text-serv-text">
                                                        Date Transaction
                                                    </td>
                                                    <td class="mb-4 text-sm font-semibold text-right text-black">
                                                        12 januari 2022
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="text-sm leading-7 text-serv-text">
                                                        Phone Number
                                                    </td>
                                                    <td class="mb-4 text-sm font-semibold text-right text-black">
                                                        9819204
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="text-sm leading-7 text-serv-text">
                                                        Address
                                                    </td>
                                                    <td class="mb-4 text-sm font-semibold text-right text-black">
                                                        Bandung
                                                    </td>
                                                </tr>

                                            </table>
                                        </div>
                                        <div>
                                            <table class="w-full mb-4">
                                                <tr>
                                                    <td class="text-sm leading-7 text-serv-text">
                                                        Price starts from:
                                                    </td>
                                                    <td class="mb-4 text-xl font-semibold text-right text-serv-button">
                                                        Rp120.000
                                                    </td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                </aside>

                            </div>
                        </section>
                    </div>
                </main>
            </div>
        </section>
    </main>

@endsection

@push('after-script')
    <script>
        function gallery() {
            return {
                featured: 'https://source.unsplash.com/_SgRNwAVNKw/1600x900/',
                active: 1,
                changeThumbnail: function(url, position) {
                    this.featured = url;
                    this.active = position;
                }
            }
        }
    </script>
@endpush
