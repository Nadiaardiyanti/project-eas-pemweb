<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-5 shadow-md">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-xl font-bold tracking-wide">
                    CREATE INVOICE
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto">

            <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-200">

                <div class="mb-6 border-b pb-4">
                    <h3 class="text-2xl font-bold text-gray-800">
                        Form Invoice
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Lengkapi informasi invoice proyek di bawah ini.
                    </p>
                </div>

                <form action="{{ route('invoice.store') }}" method="POST">
                    @csrf

                    <input type="hidden"
                        name="berita_acara_id"
                        value="{{ $ba->id }}">

                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nomor Invoice
                            </label>
                            <input type="text"
                                name="nomor_invoice"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Invoice
                            </label>
                            <input type="date"
                                name="tanggal_invoice"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Project
                            </label>
                            <input type="text"
                                value="{{ $ba->nama_project }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-600"
                                readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Client
                            </label>
                            <input type="text"
                                value="{{ $ba->customer }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-600"
                                readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Deadline Pembayaran
                            </label>
                            <input type="date"
                                name="deadline_pembayaran"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Total Nominal
                            </label>
                            <input type="number"
                                name="total_nominal"
                                id="total_nominal"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                DP Masuk
                            </label>
                            <input type="number"
                                name="dp_masuk"
                                id="dp_masuk"
                                value="0"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Sisa Pembayaran
                            </label>
                            <input type="number"
                                id="sisa_pembayaran"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-600"
                                readonly>
                        </div>

                    </div>

                    <div class="mt-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Keterangan
                        </label>
                        <textarea
                            name="keterangan"
                            rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <div class="flex justify-between mt-8">
                        <a href="{{ route('ba.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition duration-200">
                            Kembali
                        </a>

                        <button type="submit"
                            class="bg-blue-900 hover:bg-blue-800 text-white px-6 py-3 rounded-xl shadow-md transition duration-200">
                            Simpan Invoice
                        </button>
                    </div>

                </form>

            </div>
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

        hitungSisa();
    </script>
</x-app-layout>