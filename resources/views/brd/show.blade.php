<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-900 text-white py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-sans antialiased text-lg font-semibold">
                    DETAIL BUSINESS REQUIREMENT DOCUMENT
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">

            <div class="border-b pb-4 mb-6">
                <h3 class="text-2xl font-bold text-blue-900">
                    {{ $brd->judul }}
                </h3>
                <p class="text-sm text-gray-500 mt-1">
                    {{ $brd->nomor_brd }}
                </p>
            </div>

            <form action="{{ route('brd.update', $brd->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="bg-gray-50 p-5 rounded border border-gray-300">
                        <h4 class="font-bold text-blue-900 mb-4">
                            Informasi BRD
                        </h4>

                        <label>Nomor BRD</label>
                        <input type="text" name="nomor_brd" value="{{ $brd->nomor_brd }}"
                            class="border p-2 w-full mb-3"
                            @if(auth()->user()->role != 'sales') readonly @endif>

                        <label>Nama Client</label>
                        <input type="text" name="client" value="{{ $brd->client }}"
                            class="border p-2 w-full mb-3"
                            @if(auth()->user()->role != 'sales') readonly @endif>

                        <label>Nama Project</label>
                        <input type="text" name="judul" value="{{ $brd->judul }}"
                            class="border p-2 w-full mb-3"
                            @if(auth()->user()->role != 'sales') readonly @endif>

                        <label>Tanggal Upload</label>
                        <input type="date" name="tanggal_upload" value="{{ $brd->tanggal_upload }}"
                            class="border p-2 w-full mb-3"
                            @if(auth()->user()->role != 'sales') readonly @endif>

                        <label>Deadline Approval</label>
                        <input type="date" name="deadline" value="{{ $brd->deadline }}"
                            class="border p-2 w-full mb-3"
                            @if(auth()->user()->role != 'sales') readonly @endif>

                        <p class="mt-2">
                            <b>Dibuat oleh:</b> {{ $brd->sales->name }}
                        </p>

                        <label class="block mt-4">Deskripsi</label>
                        <textarea name="deskripsi" class="border p-2 w-full mb-3" rows="5"
                            @if(auth()->user()->role != 'sales') readonly @endif>{{ $brd->deskripsi }}</textarea>
                    </div>

                    <div class="bg-gray-50 p-5 rounded border border-gray-300">
                        <h4 class="font-bold text-blue-900 mb-4">
                            Status Approval
                        </h4>

                        <div class="mb-4">
                            <p class="font-bold">Engineering</p>
                            <span class="inline-block mt-1 px-3 py-1 rounded text-white text-sm
                                @if($brd->status_engineering == 'approved')
                                    bg-blue-900
                                @elseif($brd->status_engineering == 'rejected')
                                    bg-red-700
                                @else
                                    bg-gray-400
                                @endif">
                                {{ strtoupper($brd->status_engineering) }}
                            </span>

                            <p class="mt-2 text-sm">
                                <b>Catatan:</b> {{ $brd->notes_engineering ?? '-' }}
                            </p>
                        </div>

                        <hr class="my-4">

                        <div class="mb-4">
                            <p class="font-bold">Finance</p>
                            <span class="inline-block mt-1 px-3 py-1 rounded text-white text-sm
                                @if($brd->status_finance == 'approved')
                                    bg-blue-900
                                @elseif($brd->status_finance == 'rejected')
                                    bg-red-700
                                @else
                                    bg-gray-400
                                @endif">
                                {{ strtoupper($brd->status_finance) }}
                            </span>

                            <p class="mt-2 text-sm">
                                <b>Catatan:</b> {{ $brd->notes_finance ?? '-' }}
                            </p>
                        </div>

                        <hr class="my-4">

                        <div>
                            <p class="font-bold">Final Status</p>
                            <span class="inline-block mt-1 px-3 py-1 rounded text-white text-sm
                                @if($brd->status_final == 'approved')
                                    bg-blue-900
                                @elseif($brd->status_final == 'rejected' || $brd->status_final == 'revision')
                                    bg-red-700
                                @else
                                    bg-gray-400
                                @endif">
                                {{ strtoupper($brd->status_final) }}
                            </span>
                        </div>
                    </div>
                </div>

                <hr class="my-6">

                <h4 class="font-bold text-blue-900 mb-3">File BRD</h4>

                @foreach ($brd->files as $file)
                    <div class="mb-2 bg-gray-50 border border-gray-300 p-3 rounded flex justify-between items-center">
                        <span>{{ $file->nama_file }}</span>

                        <a href="{{ asset($file->path_file) }}"
                           class="bg-blue-900 text-white px-3 py-1 rounded"
                           target="_blank">
                            Download
                        </a>
                    </div>
                @endforeach

                @if(auth()->user()->role == 'sales')
                    <hr class="my-6">

                    <div class="flex justify-between items-center">
                        <a href="{{ route('brd.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded">
                            Kembali
                        </a>

                        <button type="submit"
                            class="bg-green-700 text-white px-4 py-2 rounded">
                            Save BRD
                        </button>
                    </div>
                @endif
            </form>

            @if(auth()->user()->role == 'engineering')
                <hr class="my-6">

                <h4 class="font-bold text-blue-900 mb-3">Approval Engineering</h4>

                <form action="{{ route('brd.approvalEngineering', $brd->id) }}" method="POST">
                    @csrf

                    <label>Status</label>
                    <select name="status_engineering" class="border p-2 w-full mb-4">
                        <option value="approved" {{ $brd->status_engineering == 'approved' ? 'selected' : '' }}>Approve</option>
                        <option value="rejected" {{ $brd->status_engineering == 'rejected' ? 'selected' : '' }}>Reject</option>
                    </select>

                    <label>Catatan Engineering</label>
                    <textarea name="notes_engineering" class="border p-2 w-full mb-4">{{ $brd->notes_engineering }}</textarea>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('brd.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded">
                            Kembali
                        </a>

                        <button type="submit"
                            class="bg-blue-900 text-white px-4 py-2 rounded">
                            Simpan Approval Engineering
                        </button>
                    </div>
                </form>
            @endif

            @if(auth()->user()->role == 'finance' && $brd->status_engineering == 'approved')
                <hr class="my-6">

                <h4 class="font-bold text-blue-900 mb-3">Approval Finance</h4>

                <form action="{{ route('brd.approvalFinance', $brd->id) }}" method="POST">
                    @csrf

                    <label>Status</label>
                    <select name="status_finance" class="border p-2 w-full mb-4">
                        <option value="approved" {{ $brd->status_finance == 'approved' ? 'selected' : '' }}>Approve</option>
                        <option value="rejected" {{ $brd->status_finance == 'rejected' ? 'selected' : '' }}>Reject</option>
                    </select>

                    <label>Catatan Finance</label>
                    <textarea name="notes_finance" class="border p-2 w-full mb-4">{{ $brd->notes_finance }}</textarea>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('brd.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded">
                            Kembali
                        </a>

                        <button type="submit"
                            class="bg-blue-900 text-white px-4 py-2 rounded">
                            Simpan Approval Finance
                        </button>
                    </div>
                </form>
            @endif

            @if(auth()->user()->role != 'sales' && !(auth()->user()->role == 'engineering') && !(auth()->user()->role == 'finance' && $brd->status_engineering == 'approved'))
                <a href="{{ route('brd.index') }}"
                   class="inline-block mt-6 bg-gray-500 text-white px-4 py-2 rounded">
                    Kembali
                </a>
            @endif

        </div>
    </div>
</x-app-layout>