<main class="h-full overflow-y-auto">
    <div class="container mx-auto">
        <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
            <div class="col-span-8">
                <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                    Report Transactions
                </h2>
                <p class="text-sm text-gray-400">
                    {{ $transactions->count() }} Total Transactions
                </p>
            </div>
            {{-- <div class="col-span-4 lg:text-right">
                <div class="relative mt-0 md:mt-6">
                    <button type="button" wire:click="download()" formtarget="_blank"
                        class="inline-block px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-button">
                        Download Report
                    </button>
                </div>
            </div> --}}
        </div>
    </div>
    <section class="container px-6 mx-auto mt-5">
        <div class="grid gap-5 md:grid-cols-12">
            <main class="col-span-12 p-4 md:pt-0">
                <div class="flex items-center">
                    <input type="text" name="dates" id="dates"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mr-2"
                        placeholder="Date Required" onchange='Livewire.emit("selectDate", this.value)'>
                    <button type="submit"
                        class="w-80 ml-2 inline-block px-4 py-2 text-center text-white rounded-lg font-semibold bg-serv-button"
                        id="button" formtarget="_blank">
                        Download Report
                    </button>
                </div>

                <div class="mt-4 mb-2">
                    @if ($selected_date != null)
                        {{ 'Filter of ' . $selected_date }}
                    @endif
                </div>

                @if ($transactions->count() > 0)
                    <div class="px-6 py-2 mt-2 bg-white rounded-xl">
                        <table class="w-full" aria-label="Table">
                            <thead>
                                <tr class="text-sm font-normal text-left text-gray-900 border-b border-b-gray-600">
                                    <th class="py-4" scope="">OrderID</th>
                                    <th class="py-4" scope="">Customer</th>
                                    <th class="py-4" scope="">Date</th>
                                    <th class="py-4" scope="">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($transactions as $tr)
                                    <tr class="text-gray-700">
                                        <td class="px-1 py-5 text-sm">
                                            {{ $tr->kode_order }}
                                        </td>
                                        <td class="px-1 py-5 text-sm">
                                            {{ $tr->name }}
                                        </td>
                                        <td class="px-1 py-5 text-sm">
                                            {{ date('D, d M Y', strtotime($tr->date_transaction)) }}
                                        </td>
                                        <td class="px-1 py-5 text-sm">
                                            @currency($tr->totalCost)
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h1>Tidak ada transaksi</h1>
                @endif
                <br>

                <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
                <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
                <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
                <link rel="stylesheet" type="text/css"
                    href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
                <script>
                    $('#dates').daterangepicker();
                </script>
            </main>

        </div>
    </section>
</main>
