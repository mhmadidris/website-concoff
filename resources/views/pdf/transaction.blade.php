<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>INVOICE ORDER</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }

    </style>

    @extends('layouts.front')
</head>

<body>
    @php
        foreach ($transaksipdf as $keypdf) {
            $getpdf = $keypdf;
            //dd($getpdf);
        }
    @endphp

    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset('frontend/images/main-logo.png') }}" alt="logo"
                                    style="width: 2.5em;">
                            </td>

                            <td>
                                <h3 class="font-medium text-base">INVOICE</h3>
                                <h2 class="text-lg" style="font-weight: 700;">{{ $getpdf->kode_order }}</h2>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">

                    <div class="border border-t-2 border-gray-200 mb-2 px-3"></div>

                    <table>
                        <tr>
                            @php
                                foreach ($admin as $keyadmin) {
                                    $admin = $keyadmin;
                                }
                            @endphp
                            <td class="w-1/2">
                                <h4 class="font-bold" style="text-decoration: underline; width: 50%;">From:</h4>
                                <div class="pt-2">
                                    <h4 class="font-medium text-xs">Name:</h4>
                                    <h4 class="font-semibold text-sm">{{ $admin->name }}</h4>
                                </div>
                                <div class="pt-2">
                                    <h4 class="font-medium text-xs">Phone number:</h4>
                                    <h4 class="font-semibold text-sm">{{ $admin->phone_number }}</h4>
                                </div>
                            </td>

                            <td class="text-right" style="width: 50%;">
                                <h4 class="font-bold" style="text-decoration: underline;">Destination:</h4>
                                <div class="pt-2">
                                    <h4 class="font-medium text-xs">Name:</h4>
                                    <h4 class="font-semibold text-sm">{{ $getpdf->name }}</h4>
                                </div>
                                <div class="pt-2">
                                    <h4 class="font-medium text-xs">Phone number:</h4>
                                    <h4 class="font-semibold text-sm">{{ $getpdf->phone_number }}</h4>
                                </div>
                                <div class="pt-2">
                                    <h4 class="font-medium text-xs">Detail Address:</h4>
                                    <h4 class="font-semibold text-sm">{{ $getpdf->detail_address }}</h4>
                                </div>

                                @php
                                    // Get Province
                                    $getProv = $userProv->where('province_id', $getpdf->id_province);
                                    foreach ($getProv as $keyProv) {
                                        $valProv = $keyProv->name_province;
                                    }
                                    
                                    // Get City
                                    $getCity = $userCity->where('city_id', $getpdf->id_city);
                                    foreach ($getCity as $keyCity) {
                                        // Type City
                                        $valTypeCity = $keyCity->type;
                                    
                                        // Name City
                                        $valCity = $keyCity->name_city;
                                    }
                                @endphp
                                <div class="pt-2">
                                    <h4 class="font-medium text-xs">Province:</h4>
                                    <h4 class="font-semibold text-sm">{{ $valProv }}</h4>
                                </div>
                                <div class="pt-2">
                                    <h4 class="font-medium text-xs">City:</h4>
                                    <h4 class="font-semibold text-sm">{{ $valTypeCity . ' ' . $valCity }}</h4>
                                </div>
                                <div class="pt-2">
                                    <h4 class="font-medium text-xs">Postal Code:</h4>
                                    <h4 class="font-semibold text-sm">{{ $getpdf->zipcode }}</h4>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="border border-t-2 border-gray-200 mb-4 px-3"></div>

        <h5 class="pb-1">Date Order: <b>{{ date('D, d-m-Y', strtotime($getpdf->date_transaction)) }}</b>
        </h5>
        <table class='table table-bordered'>
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Product</th>
                    <th>Weight</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($transaksipdf as $getpdf)
                    <tr class="text-center">
                        <td>{{ $i++ }}</td>
                        <td class="text-center">{{ $getpdf->title }}</td>
                        <td>{{ $getpdf->weight }}</td>
                        <td>{{ $getpdf->jumlah }}</td>
                        <td>@currency($getpdf->price)</td>
                        <td>@currency($getpdf->price * $getpdf->jumlah)</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-between items-center mb-4 bg-gray-200 py-2">
            <div>
                <div class="text-sm">Shipment cost:</div>
                <div class="font-semibold">{{ $getpdf->id_kurir }} ({{ $getpdf->id_jenisKurir }})</div>
            </div>
            <div class="text-right font-medium">@currency($getpdf->ongkir)</div>
        </div>

        <div class="flex justify-between items-center mb-2">
            <div class="text-2xl font-medium leading-none"><span class="">Total</span>:</div>
            <div class="text-2xl text-right font-medium">@currency($getpdf->totalCost)</div>
        </div>

        <div class="border border-t-2 border-gray-200 mt-4 mb-4 px-3">
            <h1 style="float: right; font-size: 1.0em; padding-top: 1.0em;">
                @php
                    echo date('d-m-Y');
                @endphp
            </h1>
        </div>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
