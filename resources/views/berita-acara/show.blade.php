<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-900 text-white py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-lg font-semibold">
                    DETAIL BERITA ACARA
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">

            <div class="border-b pb-4 mb-6">
                <h3 class="text-2xl font-bold text-blue-900">
                    {{ $ba->nama_project }}
                </h3>
                <p class="text-sm text-gray-500 mt-1">
                    {{ $ba->nomor_ba }}
                </p>
            </div>

            <form action="{{ route('ba.update', $ba->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-5 rounded border border-gray-300">
                        <h4 class="font-bold text-blue-900 mb-4">Informasi Berita Acara</h4>

                        <label>Nomor BA</label>
                        <input type="text" name="nomor_ba" value="{{ $ba->nomor_ba }}"
                            class="border p-2 w-full mb-3"
                            @if(auth()->user()->role != 'engineering') readonly @endif>

                        <label>Nama Project</label>
                        <input type="text" name="nama_project" value="{{ $ba->nama_project }}"
                            class="border p-2 w-full mb-3"
                            @if(auth()->user()->role != 'engineering') readonly @endif>

                        <label>Customer</label>
                        <input type="text" name="customer" value="{{ $ba->customer }}"
                            class="border p-2 w-full mb-3"
                            @if(auth()->user()->role != 'engineering') readonly @endif>

                        <label>Tanggal BA</label>
                        <input type="date" name="tanggal_ba" value="{{ $ba->tanggal_ba }}"
                            class="border p-2 w-full mb-3"
                            @if(auth()->user()->role != 'engineering') readonly @endif>

                        <label>Deadline</label>
                        <input type="date" name="deadline" value="{{ $ba->deadline }}"
                            class="border p-2 w-full mb-3"
                            @if(auth()->user()->role != 'engineering') readonly @endif>

                        <p class="mt-2">
                            <b>Kode BRD:</b> {{ $ba->brd->nomor_brd }}
                        </p>

                        <label class="block mt-4">Keterangan</label>
                        <textarea name="keterangan" class="border p-2 w-full mb-3" rows="4"
                            @if(auth()->user()->role != 'engineering') readonly @endif>{{ $ba->keterangan }}</textarea>
                    </div>

                    <div class="bg-gray-50 p-5 rounded border border-gray-300">
                        <h4 class="font-bold text-blue-900 mb-4">Status Approval Finance</h4>

                        <p class="font-bold">Status</p>
                        <span class="inline-block mt-1 px-3 py-1 rounded text-white text-sm
                            @if($ba->status == 'approved')
                                bg-green-900
                            @elseif($ba->status == 'rejected')
                                bg-red-700
                            @else
                                bg-gray-400
                            @endif">
                            {{ strtoupper($ba->status) }}
                        </span>

                        <div class="mt-4">
                            <p class="font-bold">Catatan Finance:</p>
                            <p class="text-gray-700">{{ $ba->notes_finance ?? '-' }}</p>
                        </div>

                        <hr class="my-4">

                        <label>Pihak Pertama</label>
                        <input type="text" name="pihak_pertama" value="{{ $ba->pihak_pertama }}"
                            class="border p-2 w-full mb-3"
                            @if(auth()->user()->role != 'engineering') readonly @endif>

                        <label>Pihak Kedua</label>
                        <input type="text" name="pihak_kedua" value="{{ $ba->pihak_kedua }}"
                            class="border p-2 w-full mb-3"
                            @if(auth()->user()->role != 'engineering') readonly @endif>
                    </div>
                </div>

                @if(auth()->user()->role == 'engineering')
                    <hr class="my-6">

                    <div class="flex justify-between items-center">
                        <a href="{{ route('ba.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded">
                            Kembali
                        </a>

                        <div class="flex gap-2">
                            <button type="submit"
                                class="bg-green-700 text-white px-4 py-2 rounded">
                                Save BA
                            </button>

                            <a href="{{ route('ba.dokumen', $ba->id) }}"
                               class="bg-blue-900 text-white px-4 py-2 rounded">
                                Lihat Dokumen BA
                            </a>
                        </div>
                    </div>
                @endif
            </form>

            @if(auth()->user()->role == 'finance')
                <hr class="my-6">

                <h4 class="font-bold text-blue-900 mb-3">
                    Approval Finance
                </h4>

                <form action="{{ route('ba.approvalFinance', $ba->id) }}" method="POST">
                    @csrf

                    <label>Status</label>
                    <select name="status" class="border p-2 w-full mb-4">
                        <option value="approved" {{ $ba->status == 'approved' ? 'selected' : '' }}>
                            Approve
                        </option>
                        <option value="rejected" {{ $ba->status == 'rejected' ? 'selected' : '' }}>
                            Reject
                        </option>
                    </select>

                    <label>Catatan Finance</label>
                    <textarea name="notes_finance" class="border p-2 w-full mb-4">{{ $ba->notes_finance }}</textarea>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('ba.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded">
                            Kembali
                        </a>

                        <div class="flex gap-2">
                            <button type="submit"
                                class="bg-blue-900 text-white px-4 py-2 rounded">
                                Simpan Approval Finance
                            </button>

                            <a href="{{ route('ba.dokumen', $ba->id) }}"
                               class="bg-green-700 text-white px-4 py-2 rounded">
                                Lihat Dokumen BA
                            </a>
                        </div>
                    </div>
                </form>
            @endif

        </div>
    </div>
</x-app-layout>