@extends('layouts.app')

@section('title', ' Coffee Shop')

@section('content')

<main class="h-full overflow-y-auto">
    <div class="container mx-auto">
        <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
            <div class="col-span-8">
                <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                    Bertjorak Product
                </h2>
                <p class="text-sm text-gray-400">
                    Total Product
                </p>
            </div>
            <div class="col-span-4 lg:text-right">
                <div class="relative mt-0 md:mt-6">
                    <a href="{{ route('dashboard.product.create') }}" class="inline-block px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-button">
                        + Add New Product
                    </a>
                </div>
            </div>
        </div>
    </div>
    <section class="container px-6 mx-auto mt-5">
        <div class="grid gap-5 md:grid-cols-12">
            <main class="col-span-12 p-4 md:pt-0">
                {{-- @if (count($data) > 0) --}}
                <div class="px-6 py-2 mt-2 bg-white rounded-xl">
                    <table class="w-full" aria-label="Table">
                        <thead>
                            <tr class="text-sm font-normal text-left text-gray-900 border-b border-b-gray-600">
                                <th class="py-4" scope="">Coffeshop</th>
                                <th class="py-4" scope="">Latitude</th>
                                <th class="py-4" scope="">Longitude</th>
                                <th class="py-4" scope="">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($data as $d)
                            <tr class="text-gray-700">
                                <td class=" px-1 py-5">
                                    <div class="flex items-center text-sm">
                                        <div class="relative w-10 h-10 mr-3 rounded-full md:block">
                                            <div class="relative w-14 h-11">
                                                @php
                                                $expiresAt = new \DateTime('tomorrow');
                                                $imageReference = app('firebase.storage')->getBucket()->object("Images/".$d['imageUrl']);

                                                if ($imageReference->exists()) {
                                                $image = $imageReference->signedUrl($expiresAt);
                                                } else {
                                                $image = null;
                                                }
                                                // dd($image);
                                                @endphp
                                                <div class="m-auto" style="width: 2.5rem; height: 2.5rem;">
                                                    <img src="{{ $image }}" alt="image-product" class="object-cover w-full h-full rounded-full">
                                                </div>
                                            </div>


                                        </div>
                                        <div class="ml-2">
                                            <a href="{{ route('detail.show', $d->id()) }}" class="font-medium text-black">
                                                {{ $d['nameCoffeeShop'] }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-1 py-5 text-sm">
                                    {{ $d['location']->latitude() . "° S" }}
                                </td>
                                <td class="px-1 py-5 text-sm">
                                    {{ $d['location']->longitude() . "° E" }}
                                </td>
                                {{-- <td class="px-1 py-5 text-sm">
                    <a href="{{ route('dashboard.product.edit', $d->id_product) }}" class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-email">
                                Edit Product
                                </a>
                                </td>
                                <td class="px-1 py-5 text-sm">
                                    <form action="{{ route('dashboard.product.destroy', $d->id_product) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger show-alert-delete-box" type="submit">Hapus</button>
                                    </form>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- @else
                <h1>Product Belum ada</h1>
                @endif
                <br>
                {{ $data->links('pagination::simple-tailwind') }} --}}
            </main>
        </div>
    </section>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Are you sure you want to delete this record?"
            , text: "If you delete this, it will be gone forever."
            , icon: "warning"
            , type: "warning"
            , buttons: ["Cancel", "Yes!"]
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });

</script>

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
