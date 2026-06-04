<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-900 text-white py-4 no-print">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-lg font-semibold">
                    DOKUMEN INVOICE
                </h2>
            </div>
        </div>
    </x-slot>

    <style>
        @media print {
            body {
                background: white !important;
            }

            .no-print {
                display: none !important;
            }

            .invoice-paper {
                box-shadow: none !important;
                margin: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
            }
        }
    </style>

    <div class="py-8">
        <div class="invoice-paper max-w-4xl mx-auto bg-white p-10 rounded shadow">

            <div class="flex justify-between items-start border-b-2 border-gray-800 pb-4">
                <div>
                    <h2 class="text-2xl font-bold text-blue-900">
                        PT. SAMATORINDO GAS TBK
                    </h2>
                    <p class="text-sm text-gray-600">
                        Digital Project Management Division
                    </p>
                </div>

                <div class="text-right">
                    <p class="text-sm text-gray-500">Nomor Invoice</p>
                    <p class="font-bold text-blue-900">
                        {{ $invoice->nomor_invoice }}
                    </p>

                    <p class="text-sm text-gray-500 mt-3">Tanggal Invoice</p>
                    <p class="font-semibold">
                        {{ \Carbon\Carbon::parse($invoice->tanggal_invoice)->format('d/m/Y') }}
                    </p>
                </div>
            </div>

            <div class="text-center mt-10">
                <h1 class="font-bold underline text-2xl">
                    INVOICE
                </h1>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-10">
                <div class="bg-gray-50 border rounded-xl p-5">
                    <p class="text-xs text-gray-500 font-bold uppercase">
                        Ditagihkan Kepada
                    </p>
                    <p class="font-bold text-lg mt-1">
                        {{ $invoice->beritaAcara->customer }}
                    </p>
                </div>

                <div class="bg-gray-50 border rounded-xl p-5">
                    <p class="text-xs text-gray-500 font-bold uppercase">
                        Nama Project
                    </p>
                    <p class="font-bold text-lg mt-1">
                        {{ $invoice->beritaAcara->nama_project }}
                    </p>
                </div>
            </div>

            <div class="mt-8">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-blue-900 text-white">
                            <th class="border p-3 text-left">Keterangan</th>
                            <th class="border p-3 text-right">Nominal</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="border p-3">
                                Total Nominal Proyek
                            </td>
                            <td class="border p-3 text-right">
                                Rp {{ number_format($invoice->total_nominal, 0, ',', '.') }}
                            </td>
                        </tr>

                        <tr>
                            <td class="border p-3">
                                DP Masuk
                            </td>
                            <td class="border p-3 text-right">
                                Rp {{ number_format($invoice->dp_masuk, 0, ',', '.') }}
                            </td>
                        </tr>

                        <tr class="font-bold bg-gray-50">
                            <td class="border p-3">
                                Sisa Pembayaran
                            </td>
                            <td class="border p-3 text-right">
                                Rp {{ number_format($invoice->sisa_pembayaran, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-8">
                <div>
                    <p class="font-bold">Deadline Pembayaran</p>
                    <p>
                        {{ $invoice->deadline_pembayaran ? \Carbon\Carbon::parse($invoice->deadline_pembayaran)->format('d/m/Y') : '-' }}
                    </p>
                </div>

                <div>
                    <p class="font-bold">Status Pembayaran</p>
                    @if($invoice->status == 'lunas')
                        <span class="inline-block mt-1 bg-green-700 text-white px-3 py-1 rounded">
                            LUNAS
                        </span>
                    @else
                        <span class="inline-block mt-1 bg-gray-500 text-white px-3 py-1 rounded">
                            PENDING
                        </span>
                    @endif
                </div>
            </div>

            @if($invoice->keterangan)
                <div class="mt-8">
                    <p class="font-bold">Keterangan:</p>
                    <p class="text-gray-700">
                        {{ $invoice->keterangan }}
                    </p>
                </div>
            @endif

            <div class="mt-16 grid grid-cols-2 gap-12 text-center">
                <div>
                    <p class="font-bold">Finance</p>
                    <div class="mt-20 border-t pt-2">
                        PT. Samatorindo Gas TBK
                    </div>
                </div>

                <div>
                    <p class="font-bold">Sales / Client</p>
                    <div class="mt-20 border-t pt-2">
                        {{ $invoice->beritaAcara->customer }}
                    </div>
                </div>
            </div>

            <div class="mt-10 flex justify-between no-print">
                <a href="{{ route('invoice.show', $invoice->id) }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded">
                    Kembali
                </a>

                <button onclick="window.print()"
                        class="bg-blue-900 text-white px-4 py-2 rounded">
                    Cetak Invoice
                </button>
            </div>

        </div>
    </div>
</x-app-layout>