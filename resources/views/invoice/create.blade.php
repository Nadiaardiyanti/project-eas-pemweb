<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-900 text-white py-4">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-lg font-semibold">
                    CREATE INVOICE
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

            <form action="{{ route('invoice.store') }}" method="POST">
                @csrf

                <input type="hidden"
                       name="berita_acara_id"
                       value="{{ $ba->id }}">

                <div class="mb-4">
                    <label class="block font-semibold mb-2">Nomor Invoice</label>
                    <input type="text"
                           name="nomor_invoice"
                           class="border p-2 w-full rounded"
                           required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">Nama Project</label>
                    <input type="text"
                           value="{{ $ba->nama_project }}"
                           class="border p-2 w-full rounded bg-gray-100"
                           readonly>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">Client</label>
                    <input type="text"
                           value="{{ $ba->customer }}"
                           class="border p-2 w-full rounded bg-gray-100"
                           readonly>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">Tanggal Invoice</label>
                    <input type="date"
                           name="tanggal_invoice"
                           class="border p-2 w-full rounded"
                           required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">Deadline Pembayaran</label>
                    <input type="date"
                           name="deadline_pembayaran"
                           class="border p-2 w-full rounded">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">Total Nominal</label>
                    <input type="number"
                           name="total_nominal"
                           id="total_nominal"
                           class="border p-2 w-full rounded"
                           required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">DP Masuk</label>
                    <input type="number"
                           name="dp_masuk"
                           id="dp_masuk"
                           class="border p-2 w-full rounded"
                           value="0"
                           required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">Sisa Pembayaran</label>
                    <input type="number"
                           id="sisa_pembayaran"
                           class="border p-2 w-full rounded bg-gray-100"
                           readonly>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">Keterangan</label>
                    <textarea name="keterangan"
                              rows="4"
                              class="border p-2 w-full rounded"></textarea>
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('ba.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded">
                        Kembali
                    </a>

                    <button type="submit"
                        class="bg-blue-900 text-white px-4 py-2 rounded">
                        Simpan Invoice
                    </button>
                </div>

            </form>

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

        total.addEventListener('input', hitungSisa);
        dp.addEventListener('input', hitungSisa);
    </script>
</x-app-layout>