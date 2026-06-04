<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-900 text-white py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-lg font-semibold">
                    BERITA ACARA
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded shadow">

            <table class="w-full mt-6 border">
                <thead>
                    <tr class="bg-blue-900 text-white">
                        <th class="border p-3">NO</th>
                        <th class="border p-3">NOMOR BA</th>
                        <th class="border p-3">NAMA PROJECT</th>
                        <th class="border p-3 text-center">DEADLINE</th>
                        <th class="border p-3 text-center">STATUS</th>
                        <th class="border p-3 text-center">AKSI</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($beritaAcaras as $ba)
                        <tr>
                            <td class="border p-3 text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border p-3">
                                {{ $ba->nomor_ba }}
                            </td>

                            <td class="border p-3">
                                {{ $ba->nama_project }}
                            </td>

                            <td class="border p-3 text-center">
                                {{ $ba->deadline ? \Carbon\Carbon::parse($ba->deadline)->format('d/m/Y') : '-' }}
                            </td>

                            <td class="border p-3 text-center">
                                <span class="px-4 py-2 rounded text-white text-sm font-semibold
                                    @if($ba->status == 'approved')
                                        bg-green-900
                                    @elseif($ba->status == 'rejected')
                                        bg-red-700
                                    @else
                                        bg-gray-400
                                    @endif">
                                    {{ strtoupper($ba->status) }}
                                </span>
                            </td>

                            <td class="border p-3 text-center">
    <div class="flex justify-center items-center gap-2">

        @if(auth()->user()->role != 'sales')
            <a href="{{ route('ba.show', $ba->id) }}"
               class="bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded">
                DETAIL
            </a>
        @endif

        <a href="{{ route('ba.dokumen', $ba->id) }}"
           class="bg-yellow-700 hover:bg-yellow-800 text-white px-4 py-2 rounded">
            LIHAT
        </a>

        @if(auth()->user()->role == 'finance'
    && $ba->status == 'approved'
    && !$ba->invoice)

    <a href="{{ route('invoice.create', $ba->id) }}"
       class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded">
        CREATE INVOICE
    </a>

@endif

        @if(auth()->user()->role == 'engineering')
            <form action="{{ route('ba.destroy', $ba->id) }}"
                  method="POST"
                  onsubmit="return confirm('Apakah yakin ingin menghapus Berita Acara ini?')">
                @csrf
                @method('DELETE')

                <button type="submit"
                    class="text-red-500 hover:text-red-700 p-2 transition"
                    title="Hapus BA">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="2"
                         stroke="currentColor"
                         class="w-5 h-5">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M6 7h12M9 7V5a1 1 0 011-1h4a1 1 0 011 1v2m-7 0v11m4-11v11m4-11v11M5 7l1 13a1 1 0 001 1h10a1 1 0 001-1l1-13"/>
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