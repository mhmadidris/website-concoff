<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reports</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

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

        .text-left {
            text-align: left;
        }

    </style>

    @extends('layouts.front')
</head>

<body>
    <div class="flex justify-start items-center mb-2 bg-gray-200 py-2">
        <div class="text-right font-bold">Date reports :</div>
        <div class="text-sm ml-2">
            {{ date('d M Y', strtotime($startDate)) . ' - ' . date('d M Y', strtotime($endDate)) }}</div>
    </div>

    <table class='table table-bordered'>
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>OrderID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
                $totalBalance = 0;
            @endphp
            @foreach ($transactions as $getpdf)
                <tr class="text-center">
                    <td>{{ $i++ }}</td>
                    <td class="text-center">{{ $getpdf->kode_order }}</td>
                    <td class="text-left">{{ $getpdf->name }}</td>
                    <td>{{ $getpdf->date_order }}</td>
                    <td>@currency($getpdf->totalCost)</td>
                </tr>
                @php
                    $totalBalance += $getpdf->totalCost;
                @endphp
            @endforeach
        </tbody>
    </table>

    <div class="flex justify-between items-center mb-2">
        <div class="text-2xl font-medium leading-none"><span class="">Total balance</span>:</div>
        <div class="text-2xl text-right font-medium">@currency($totalBalance)</div>
    </div>

    <div class="border border-t-2 border-gray-200 mt-4 mb-4 px-3">
        <h1 style="float: right; font-size: 0.75em; padding-top: 1.0em;">
            {{ 'Print date : ' . date('d M Y') }}
        </h1>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
