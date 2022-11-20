<div>
    {{-- Pilih Jasa Pengiriman --}}
    <div class="preview-summary pt-2">
        Jasa Kirim
    </div>
    <select class="form-select" wire:model="pilihKurir" name="pilihKurir" id="cost" required>
        @if (is_array($cost) || is_object($cost))
            <option value="none" selected>-- Pilih Kurir --</option>
            @foreach ($cost as $k => $value)
                <option value="{{ $value['name'] }}">{{ $value['name'] }}</option>
            @endforeach

        @endif
    </select>

    {{-- Pilih Jenis Pengiriman --}}
    <div class="preview-summary pt-2">
        Jenis Pengiriman
    </div>
    <select class="form-select" wire:model="jenisKurir" name="pilihJenisKurir" id="cost" required>
        <option value="none" selected>-- Pilih Jenis --</option>
        @foreach ($cost as $k => $y)
            @if ($y['name'] == $pilihKurir)
                @foreach ($y['costs'] as $p)
                    <option value="{{ $p['service'] }}">{{ $p['service'] }}</option>
                @endforeach
            @endif
        @endforeach
    </select>

    {{-- Ongkos Kirim Display --}}
    <div class="d-flex justify-content-between">
        <div class="preview-summary pt-1">
            Ongkos Kirim:
        </div>
        <span class="p-2" wire:model="ongkirResult">
            @if (!is_array($jenisKurir) || is_object($jenisKurir))
                @foreach ($cost as $k => $y)
                    @if ($y['name'] == $pilihKurir)
                        @foreach ($y['costs'] as $p)
                            @if ($p['service'] == $jenisKurir)
                                @foreach ($p['cost'] as $harga)
                                    @currency($harga['value'])
                                    @php
                                        $hargaOngkir = $harga['value'];
                                    @endphp
                                    <input type="text" name="ongkir" value="{{ $hargaOngkir }}" hidden>
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
                    @if ($y['name'] == $pilihKurir)
                        @foreach ($y['costs'] as $p)
                            @if ($p['service'] == $jenisKurir)
                                @foreach ($p['cost'] as $harga)
                                    @php
                                        $convert = $harga['etd'];
                                        $hasilKonversi = str_replace('HARI', '', $convert);
                                    @endphp
                                    @if ($hasilKonversi == '0' || $hasilKonversi == '1-1')
                                        1 hari pengiriman
                                    @else
                                        {{ $hasilKonversi }} hari pengiriman
                                    @endif
                                    <input type="text" name="durasi" value="{{ $hasilKonversi }}" hidden>
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

    {{-- Total Harga Barang --}}
    <div class="total-summary mt-1">
        Total Harga Barang
        @if (!$hargaOngkir == null)
            <span class="float-end">@currency($cartsPrice) </span>
        @else
            <span class="float-end">@currency(0)</span>
        @endif
    </div>

    {{-- Total Harga Belanja --}}
    <div class="total-summary mt-1">
        Total Harga Belanja
        @if (!$hargaOngkir == null)
            <span class="float-end">@currency($cartsPrice + $hargaOngkir) </span>
            <input type="number" name="totalPrice" value="{{ $cartsPrice + $hargaOngkir }}" readonly hidden>
        @else
            <span class="float-end">@currency(0)</span>
        @endif
    </div>
</div>
