<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-900 text-white py-4">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-lg font-semibold">
                    INVOICE
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded shadow">

            <table class="w-full border">
                <thead>
                    <tr class="bg-blue-900 text-white">
                        <th class="border p-3">NO</th>
                        <th class="border p-3">NO INVOICE</th>
                        <th class="border p-3">PROJECT</th>
                        <th class="border p-3">CLIENT</th>
                        <th class="border p-3">SISA TAGIHAN</th>
                        <th class="border p-3">STATUS</th>
                        <th class="border p-3">AKSI</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($invoices as $invoice)
                    <tr>
                        <td class="border p-3 text-center">
                            {{ $loop->iteration }}
                        </td>

                        <td class="border p-3">
                            {{ $invoice->nomor_invoice }}
                        </td>

                        <td class="border p-3">
                            {{ $invoice->beritaAcara->nama_project }}
                        </td>

                        <td class="border p-3">
                            {{ $invoice->beritaAcara->customer }}
                        </td>

                        <td class="border p-3">
                            Rp {{ number_format($invoice->sisa_pembayaran,0,',','.') }}
                        </td>

                        <td class="border p-3 text-center">
                            @if($invoice->status == 'lunas')
                                <span class="bg-green-700 text-white px-3 py-1 rounded">
                                    LUNAS
                                </span>
                            @else
                                <span class="bg-gray-500 text-white px-3 py-1 rounded">
                                    PENDING
                                </span>
                            @endif
                        </td>

                        <td class="border p-3 text-center">
    <div class="flex justify-center items-center gap-2">

        <a href="{{ route('invoice.show', $invoice->id) }}"
           class="bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded">
            DETAIL
        </a>

        <a href="{{ route('invoice.dokumen', $invoice->id) }}"
           class="bg-yellow-700 hover:bg-yellow-800 text-white px-4 py-2 rounded">
            LIHAT
        </a>

        @if(auth()->user()->role == 'finance')
        <form action="{{ route('invoice.destroy', $invoice->id) }}"
      method="POST"
      onsubmit="return confirm('Hapus invoice ini?')">

    @csrf
    @method('DELETE')

    <button type="submit"
        class="text-red-600 hover:text-red-800">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-6 w-6"
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
</x-app-layout>