```php
<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-5 shadow-md">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-xl font-bold tracking-wide">
                    INVOICE MANAGEMENT
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto">

            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">

                <div class="p-6 border-b">
                    <h3 class="text-2xl font-bold text-gray-800">
                        Daftar Invoice
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Kelola seluruh data invoice proyek pelanggan.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">

                        <thead>
                            <tr class="bg-blue-900 text-white">
                                <th class="px-4 py-4 text-center">NO</th>
                                <th class="px-4 py-4 text-left">NO INVOICE</th>
                                <th class="px-4 py-4 text-left">PROJECT</th>
                                <th class="px-4 py-4 text-left">CLIENT</th>
                                <th class="px-4 py-4 text-right">SISA TAGIHAN</th>
                                <th class="px-4 py-4 text-center">STATUS</th>
                                <th class="px-4 py-4 text-center">AKSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($invoices as $invoice)
                            <tr class="border-b hover:bg-gray-50 transition">

                                <td class="px-4 py-4 text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-4 py-4 font-medium text-gray-700">
                                    {{ $invoice->nomor_invoice }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $invoice->beritaAcara->nama_project }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $invoice->beritaAcara->customer }}
                                </td>

                                <td class="px-4 py-4 text-right font-semibold text-gray-700">
                                    Rp {{ number_format($invoice->sisa_pembayaran,0,',','.') }}
                                </td>

                                <td class="px-4 py-4 text-center">
                                    @if($invoice->status == 'lunas')
                                        <span class="inline-flex px-4 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                                            LUNAS
                                        </span>
                                    @else
                                        <span class="inline-flex px-4 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-700">
                                            PENDING
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-4">
                                    <div class="flex justify-center items-center gap-2">

                                        <a href="{{ route('invoice.show', $invoice->id) }}"
                                            class="bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm transition">
                                            Detail
                                        </a>

                                        <a href="{{ route('invoice.dokumen', $invoice->id) }}"
                                            class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg text-sm transition">
                                            Dokumen
                                        </a>

                                        @if(auth()->user()->role == 'finance')
                                        <form action="{{ route('invoice.destroy', $invoice->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Hapus invoice ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="bg-red-100 hover:bg-red-200 text-red-600 p-2 rounded-lg transition">

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor">

                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                                                        a2 2 0 01-1.995-1.858L5 7m5
                                                        4v6m4-6v6M1 7h22M9
                                                        3h6a1 1 0 011 1v2H8V4a1
                                                        1 0 011-1z"/>
                                                </svg>

                                            </button>
                                        </form>
                                        @endif

                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
```
