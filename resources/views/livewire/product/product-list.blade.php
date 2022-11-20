<div>

    <div class="border rounded">
        <div class="flex items-center justify-content-center px-4 border-r">
            <span class="fa fa-search form-control-feedback"></span>
        </div>
        <input type="text" class="px-4 py-2 w-100 rounded-3" style="outline: none; border:none;" wire:model="search"
            placeholder="Search...">
    </div>
    <br>

    <div class="row min-h-screen">
        @forelse ($products as $p)
            <div class="col-12 col-lg-4">
                <a href="{{ route('detail.show', $p->id_product) }}" style="text-decoration: none; color: #080E09;">
                    <div class="card-related-carousel" style="padding: 1.25em;">
                        <div class="image-placeholder">
                            @php
                                $firstImg = json_decode($p->images);
                            @endphp
                            <img src="{{ asset('/storage/products/images/' . $firstImg[0]) }}" alt="images"
                                class="object-cover img-thumbnail" />
                        </div>
                        <div class="card-details">
                            <div class="caption"
                                style="font-weight: 500; font-size: 24px; color: #080E09; margin-top: 24px;">
                                {{ $p->title }}
                            </div>
                            {{-- <span class="sub-caption">150m</span> --}}
                        </div>
                        <div class="bottom-text d-flex flex-row justify-content-between">
                            <div class="price-content flex-grow-1">
                                <span class="price">@currency($p->price)</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <style>
                .center {
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                    vertical-align: center;
                }

            </style>
            <div style="height: 100vh;">
                <img src="{{ asset('assets/images/no-product-found.png') }}" style="width: 50%;"
                    class="center" alt="Not Found">
            </div>
        @endforelse

        <div style="margin-top: 2.5em;">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>

    </div>
</div>
