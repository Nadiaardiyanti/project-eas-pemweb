<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-900 text-white py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-sans antialiased text-lg font-semibold">
                    BUSINESS REQUIREMENT DOCUMENT
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded shadow">

            @if(auth()->user()->role == 'sales')
                <a href="{{ route('brd.create') }}"
                   class="bg-blue-900 text-white px-4 py-2 rounded">
                    + Create BRD
                </a>
            @endif

            <table class="w-full mt-6 border">
                <thead>
                    <tr class="bg-blue-900  text-white">
                        <th class="border p-3">NO</th>
                        <th class="border p-3">KODE BRD</th>
                        <th class="border p-3">NAMA PROJECT</th>
                        <th class="border p-3 text-center">DEADLINE</th>
                        <th class="border p-3 text-center">STATUS</th>
                        <th class="border p-3 text-center">AKSI</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($brds as $brd)
                        <tr>
                            <td class="border p-3 text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border p-3">
                                {{ $brd->nomor_brd }}
                            </td>

                            <td class="border p-3">
    {{ $brd->judul }}
</td>

<td class="border p-3 text-center">
    {{ \Carbon\Carbon::parse($brd->deadline)->format('d/m/Y') }}
</td>

                                <td class="border p-3">
                                <div class="flex justify-center gap-2">

                                    {{-- ENGINEER --}}
                                    <span
                                        class="px-4 py-2 rounded text-white text-sm font-semibold
                                        @if($brd->status_engineering == 'approved')
                                            bg-green-900
                                        @elseif($brd->status_engineering == 'rejected')
                                            bg-red-700
                                        @else
                                            bg-gray-400
                                        @endif">
                                        ENGINEER
                                    </span>

                                    {{-- FINANCE --}}
                                    <span
                                        class="px-4 py-2 rounded text-white text-sm font-semibold
                                        @if($brd->status_finance == 'approved')
                                            bg-green-900
                                        @elseif($brd->status_finance == 'rejected')
                                            bg-red-700
                                        @else
                                            bg-gray-400
                                        @endif">
                                        FINANCE
                                    </span>

                                </div>
                            </td>

                            <td class="border border-gray-300 p-3 text-center">
    <div class="flex justify-center items-center gap-2">

        <a href="{{ route('brd.show', $brd->id) }}"
           class="bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded">
            DETAIL
        </a>

        @if(auth()->user()->role == 'engineering' && $brd->status_final == 'approved')

    @if(!$brd->beritaAcara)
    <a href="{{ route('ba.create', $brd->id) }}"
       class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded">
        CREATE BA
    </a>
@else
    <a href="{{ route('ba.show', $brd->beritaAcara->id) }}"
       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
        LIHAT BA
    </a>
@endif

@endif

        @if(auth()->user()->role == 'sales')
            <form action="{{ route('brd.destroy', $brd->id) }}"
                  method="POST"
                  onsubmit="return confirm('Apakah yakin ingin menghapus BRD ini?')">
                @csrf
                @method('DELETE')

                <button type="submit"
                        class="text-red-500 hover:text-red-700 p-2 transition"
                        title="Hapus BRD">

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