<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-900 text-white py-4">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-lg font-semibold">
                    DETAIL INVOICE
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">

            <div class="border-b pb-4 mb-6">
                <h3 class="text-2xl font-bold text-blue-900">
                    {{ $invoice->beritaAcara->nama_project }}
                </h3>
                <p class="text-sm text-gray-500 mt-1">
                    {{ $invoice->nomor_invoice }}
                </p>
            </div>

            <form action="{{ route('invoice.update', $invoice->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="bg-gray-50 p-5 rounded border border-gray-300">
                        <h4 class="font-bold text-blue-900 mb-4">
                            Informasi Invoice
                        </h4>

                        <label>Nomor Invoice</label>
                        <input type="text" name="nomor_invoice"
                               value="{{ $invoice->nomor_invoice }}"
                               class="border p-2 w-full mb-3"
                               @if(auth()->user()->role != 'finance') readonly @endif>

                        <label>Nama Project</label>
                        <input type="text"
                               value="{{ $invoice->beritaAcara->nama_project }}"
                               class="border p-2 w-full mb-3 bg-gray-100"
                               readonly>

                        <label>Client</label>
                        <input type="text"
                               value="{{ $invoice->beritaAcara->customer }}"
                               class="border p-2 w-full mb-3 bg-gray-100"
                               readonly>

                        <label>Tanggal Invoice</label>
                        <input type="date" name="tanggal_invoice"
                               value="{{ $invoice->tanggal_invoice }}"
                               class="border p-2 w-full mb-3"
                               @if(auth()->user()->role != 'finance') readonly @endif>

                        <label>Deadline Pembayaran</label>
                        <input type="date" name="deadline_pembayaran"
                               value="{{ $invoice->deadline_pembayaran }}"
                               class="border p-2 w-full mb-3"
                               @if(auth()->user()->role != 'finance') readonly @endif>
                    </div>

                    <div class="bg-gray-50 p-5 rounded border border-gray-300">
                        <h4 class="font-bold text-blue-900 mb-4">
                            Informasi Pembayaran
                        </h4>

                        <label>Total Nominal</label>
                        <input type="number" name="total_nominal" id="total_nominal"
                               value="{{ $invoice->total_nominal }}"
                               class="border p-2 w-full mb-3"
                               @if(auth()->user()->role != 'finance') readonly @endif>

                        <label>DP Masuk</label>
                        <input type="number" name="dp_masuk" id="dp_masuk"
                               value="{{ $invoice->dp_masuk }}"
                               class="border p-2 w-full mb-3"
                               @if(auth()->user()->role != 'finance') readonly @endif>

                        <label>Sisa Pembayaran</label>
                        <input type="number" id="sisa_pembayaran"
                               value="{{ $invoice->sisa_pembayaran }}"
                               class="border p-2 w-full mb-3 bg-gray-100"
                               readonly>

                        <p class="font-bold mt-2">Status</p>
                        @if($invoice->status == 'lunas')
                            <span class="inline-block mt-1 bg-green-700 text-white px-3 py-1 rounded">
                                LUNAS
                            </span>
                        @else
                            <span class="inline-block mt-1 bg-gray-500 text-white px-3 py-1 rounded">
                                PENDING
                            </span>
                        @endif

                        <label class="block mt-4">Keterangan</label>
                        <textarea name="keterangan"
                                  rows="4"
                                  class="border p-2 w-full mb-3"
                                  @if(auth()->user()->role != 'finance') readonly @endif>{{ $invoice->keterangan }}</textarea>
                    </div>
                </div>

                <hr class="my-6">

                <div class="flex justify-between items-center">
                    <a href="{{ route('invoice.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded">
                        Kembali
                    </a>

                    <div class="flex gap-2">
                        @if(auth()->user()->role == 'finance')
                            <button type="submit"
                                class="bg-green-700 text-white px-4 py-2 rounded">
                                Save Invoice
                            </button>
                        @endif

                        <a href="{{ route('invoice.dokumen', $invoice->id) }}"
                           class="bg-blue-900 text-white px-4 py-2 rounded">
                            Lihat Invoice
                        </a>
                    </div>
                </div>
            </form>

            @if(auth()->user()->role == 'sales' && $invoice->status != 'lunas')
                <hr class="my-6">

                <form action="{{ route('invoice.lunas', $invoice->id) }}" method="POST">
                    @csrf

                    <button type="submit"
                        onclick="return confirm('Apakah invoice ini sudah lunas?')"
                        class="bg-green-700 text-white px-4 py-2 rounded">
                        Tandai Lunas
                    </button>
                </form>
            @endif

        </div>
    </div>

    <script>
        const total = document.getElementById('total_nominal');
        const dp = document.getElementById('dp_masuk');
        const sisa = document.getElementById('sisa_pembayaran');

        function hitungSisa() {
            const totalValue = parseFloat(total.value) || 0;
            const dpValue = parseFloat(dp.value) || 0;
            sisa.value = totalValue - dpValue;
        }

        if (total && dp && sisa) {
            total.addEventListener('input', hitungSisa);
            dp.addEventListener('input', hitungSisa);
        }
    </script>
</x-app-layout>