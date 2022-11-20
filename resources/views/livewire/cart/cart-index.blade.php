<div>
    <section class="cart-checkout w-100 h-100">
        <div class="container p-4">
            <div class="row">

                <div class="col-12 col-lg-8">

                    @if (count($carts) >= 1)
                        @foreach ($carts as $c)
                            <div class="card-product-preview p-3 mb-3">
                                <div class="d-flex flex-row">
                                    <div class="col-2">
                                        <?php $property_images = json_decode($c->images); ?>
                                        <img src="{{ asset('/storage/products/images/' . $property_images[0]) }}"
                                            alt="" loading="lazy" class="w-100">
                                    </div>
                                    <div class="col-4 name-product-preview ms-3">
                                        {{ $c->title }}
                                        <div class="size-preview">
                                            Jumlah item : {{ $c->jumlah }} item
                                        </div>
                                        <div class="size-preview">
                                            Size : {{ $c->sizeSelected }}
                                        </div>
                                        <div class="price-preview">
                                            @currency($c->price)
                                        </div>
                                    </div>


                                    <div
                                        class="col-4 d-flex text-center align-items-center justify-content-center name-product-preview ms-3">

                                        {{-- <livewire:cart.counter-barang /> --}}

                                        {{-- <div class="input-group border p-2 w-50 mx-auto" style="border-radius: 10px;">
                                        <span class="input-group-btn">
                                            <button wire:click="decrement" class="btn btn-minus pb-3 px-1">
                                                -
                                            </button>
                                        </span>
                                        <input type="text" class="form-control input-number text-center border-0"
                                            max="100" value="{{ $count }}" />
                                        <span class="input-group-btn">
                                            <button wire:click="increment" class="btn btn-add pb-3 px-1">
                                                +
                                            </button>
                                        </span>
                                    </div> --}}

                                    </div>

                                    <div
                                        class="col-2 d-flex text-center align-items-center justify-content-center name-product-preview ms-3">

                                        <form action="{{ route('cart.destroy', $c->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn">
                                                <img src="{{ asset('frontend/images/icon-delete.svg') }}" width="20"
                                                    alt="icon-delete">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="error-details">
                            Keranjang kamu kosong nih! Ayo belanja dulu
                        </div>
                    @endif


                </div>

                <div class="col-12 col-lg-4">
                    <div class="card-summary px-lg-4 py-3 mb-3">
                        <div class="caption-summary mb-3">
                            Informasi Pembayaran
                        </div>
                        @if (count($carts) >= 1)
                            @php
                                $totalPrice = 0;
                            @endphp
                            @foreach ($carts as $c)
                                <div class="preview-summary">
                                    {{ $c->title }} ({{ $c->jumlah }} item)

                                    <span class="float-end">
                                        @currency($c->price * $c->jumlah)
                                    </span>
                                </div>
                                @php
                                    $totalHargaItem = $c->price * $c->jumlah;
                                    $totalPrice += $totalHargaItem;
                                @endphp
                            @endforeach
                        @else
                            <p class="text-center opacity-50">Belum ada barang ditambahkan.</p>
                        @endif

                        {{-- Pilih Jasa Pengiriman --}}
                        <div class="preview-summary">
                            Jasa Kirim
                        </div>
                        <select class="col p-2" wire:model="pilihKurir" name="cost" id="cost">
                            @if (is_array($cost) || is_object($cost))
                                <option value="none" selected>-- Pilih Kurir --</option>
                                @foreach ($cost as $k => $value)
                                    <option value="{{ $value['code'] }}">{{ $value['name'] }}</option>
                                @endforeach

                            @endif
                        </select>

                        {{-- Pilih Jenis Pengiriman --}}
                        <div class="preview-summary">
                            Jenis Pengiriman
                        </div>
                        <select class="col p-2" wire:model="jenisKurir" name="cost" id="cost">
                            <option value="none" selected>-- Pilih Jenis --</option>
                            @foreach ($cost as $k => $y)
                                @if ($y['code'] == $pilihKurir)
                                    @foreach ($y['costs'] as $p)
                                        <option value="{{ $p['service'] }}">{{ $p['service'] }}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        </select>


                        {{-- Ongkos Kirim Display --}}
                        <div class="d-flex justify-content-between">
                            <div class="preview-summary">
                                Ongkos Kirim:
                            </div>
                            <span class="p-2" wire:model="ongkirResult">
                                @if (!is_array($jenisKurir) || is_object($jenisKurir))
                                    @foreach ($cost as $k => $y)
                                        @if ($y['code'] == $pilihKurir)
                                            @foreach ($y['costs'] as $p)
                                                @if ($p['service'] == $jenisKurir)
                                                    @foreach ($p['cost'] as $harga)
                                                        @currency($harga['value'])
                                                        @php
                                                            $hargaOngkir = $harga['value'];
                                                        @endphp
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @else
                                    <h5>none</h5>
                                @endif
                            </span>
                        </div>


                        {{-- Estimasi Pengiriman --}}
                        <div class="preview-summary mt-2">
                            <svg class="inline" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="8" stroke="#ADB2B8" stroke-width="1.5" />
                                <path d="M12 7V12L15 13.5" stroke="#ADB2B8" stroke-width="1.5" stroke-linecap="round" />
                            </svg>

                            <span>
                                @if (!$hargaOngkir == null)
                                    @foreach ($cost as $k => $y)
                                        @if ($y['code'] == $pilihKurir)
                                            @foreach ($y['costs'] as $p)
                                                @if ($p['service'] == $jenisKurir)
                                                    @foreach ($p['cost'] as $harga)
                                                        @php
                                                            $convert = $harga['etd'];
                                                            $hasilKonversi = str_replace('HARI', '', $convert);
                                                        @endphp
                                                        {{ $hasilKonversi }} hari pengiriman
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @else
                                    -
                                @endif
                            </span>
                        </div>

                        {{-- Total Harga Belanja --}}
                        <div class="total-summary mt-1">
                            Total Harga Barang
                            @if (!$hargaOngkir == null)
                                <span class="float-end">@currency($totalPrice) </span>
                            @else
                                <span class="float-end">@currency(0)</span>
                            @endif
                        </div>

                        {{-- Total Harga Belanja --}}
                        <div class="total-summary mt-1">
                            Total Harga Belanja
                            @if (!$hargaOngkir == null)
                                <span class="float-end">@currency($totalPrice + $hargaOngkir) </span>
                            @else
                                <span class="float-end">@currency(0)</span>
                            @endif
                        </div>
                    </div>

                    <div class="card-summary px-lg-4 px-2 py-3 mb-3">
                        <div class="caption-summary mb-3">
                            Rincian Pengiriman
                        </div>

                        <form action="">

                            {{-- Alamat Pembeli --}}
                            <label for="alamat" class="mb-1">Alamat Anda</label>
                            <div class="input-group w-100 mx-auto mb-2">

                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and
                                        make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>



                            {{-- Catatan Dari Pembeli --}}
                            <label for="notes" class="mb-1">Catatan</label>
                            <div class="input-group w-100 mx-auto mb-2">

                                <textarea name="notes" id="notes" class="form-control input-shipping-details" style="resize: none;" cols="10"
                                    rows="5"></textarea>
                            </div>

                            {{-- <label for="email" class="mb-1">Email</label>
                            <div class="input-group w-100 mx-auto mb-2">

                                <input type="text" id="email" class="form-control input-shipping-details" max="100"
                                    placeholder="Email penerima" />

                            </div>

                            <label for="number_phone" class="mb-1">No Handphone</label>
                            <div class="input-group w-100 mx-auto mb-2">

                                <input type="text" id="number_phone" class="form-control input-shipping-details"
                                    max="100" placeholder="No Handphone penerima" />

                            </div>

                            <label for="address" class="mb-1">Alamat Lengkap</label>
                            <div class="input-group w-100 mx-auto mb-2">

                                <input type="text" id="address" class="form-control input-shipping-details" max="100"
                                    placeholder="Alamat Lengkap penerima" />

                            </div> --}}

                            <div class="btn btn-confirm d-inline-block w-100 p-2 mt-4">
                                Checkout Now
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
