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
        <div class="max-w-5xl mx-auto bg-white p-12 rounded shadow">

            <div class="flex justify-between items-start border-b-2 border-gray-800 pb-5">
                <div>
                    <h2 class="text-2xl font-bold text-blue-900">
                        PT. SAMATORINDO GAS TBK
                    </h2>
                    <p class="text-sm text-gray-600">
                        Digital Project Management Division
                    </p>
                </div>

                <div class="text-right">
                    <p class="text-xs text-gray-500 uppercase">Nomor Dokumen</p>
                    <p class="font-bold text-blue-900">
                        {{ $ba->nomor_ba }}
                    </p>
                </div>
            </div>

           <div class="text-center mt-12 mb-8">
                <h1 class="inline-block font-bold text-xl border-b-2 border-black pb-1">
                     BERITA ACARA PERSETUJUAN PROYEK
                </h1>
            </div>

            <p class="mt-10 text-sm leading-relaxed">
                Pada hari ini, {{ \Carbon\Carbon::parse($ba->tanggal_ba)->format('d/m/Y') }},
                telah dilakukan verifikasi teknis dan finalisasi terhadap pengajuan proyek berikut:
            </p>

            <div class="grid grid-cols-2 gap-6 mt-6">
                <div class="bg-gray-50 border rounded-xl p-5">
                    <p class="text-xs text-gray-500 font-bold uppercase">
                        Nama Project
                    </p>
                    <p class="font-bold mt-1">
                        {{ $ba->nama_project }}
                    </p>
                </div>

                <div class="bg-gray-50 border rounded-xl p-5">
                    <p class="text-xs text-gray-500 font-bold uppercase">
                        Customer / Instansi
                    </p>
                    <p class="font-bold mt-1">
                        {{ $ba->customer }}
                    </p>
                </div>
            </div>

            <div class="mt-8 text-sm leading-relaxed">
                <p>
                    Berdasarkan hasil analisis, dokumen BRD dengan kode
                    <b>{{ $ba->brd->nomor_brd }}</b> telah disetujui oleh pihak Engineering
                    dan Finance. Dengan diterbitkannya Berita Acara ini, proyek dinyatakan
                    siap untuk melanjutkan ke tahap berikutnya.
                </p>

                @if($ba->keterangan)
                    <p class="mt-4">
                        <b>Keterangan:</b> {{ $ba->keterangan }}
                    </p>
                @endif
            </div>

            <div class="flex justify-between mt-24 text-center text-sm">

   <div class="w-64">
    <p class="font-bold">PIHAK PERTAMA</p>
    <p class="text-gray-500">(Client)</p>

    <div class="border-t border-gray-400 pt-2 mt-16">
        {{ $ba->pihak_pertama }}
    </div>
</div>


    <div class="w-64">
    <p class="font-bold">PIHAK KEDUA</p>
    <p class="text-gray-500">(Engineering)</p>

    <div class="border-t border-gray-400 pt-2 mt-16">
        {{ $ba->pihak_kedua }}
    </div>
</div>

</div>

            <div class="mt-12 flex justify-between print:hidden">
                <a href="{{ route('ba.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded">
                    Kembali
                </a>

                <button onclick="window.print()"
                        class="bg-blue-900 text-white px-4 py-2 rounded">
                    Cetak BA
                </button>
            </div>

        </div>
    </div>
</x-app-layout>