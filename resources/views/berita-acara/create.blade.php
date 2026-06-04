<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-900 text-white py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-sans antialiased text-lg font-semibold">
                    CREATE BERITA ACARA
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

            <form action="{{ route('ba.store') }}" method="POST">
                @csrf

                <input type="hidden"
                       name="brd_id"
                       value="{{ $brd->id }}">

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Nomor BA
                    </label>

                    <input type="text"
                           name="nomor_ba"
                           class="border p-2 w-full rounded"
                           required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Nama Project
                    </label>

                    <input type="text"
                           name="nama_project"
                           value="{{ $brd->judul }}"
                           class="border p-2 w-full rounded"
                           required>
                </div>

                <div class="mb-4">
    <label class="block font-semibold mb-2">
        Customer
    </label>

    <input type="text"
           name="customer"
           value="{{ $brd->client }}"
           class="border p-2 w-full rounded"
           required>
</div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Tanggal Berita Acara
                    </label>

                    <input type="date"
                           name="tanggal_ba"
                           class="border p-2 w-full rounded"
                           required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Deadline Approval
                    </label>

                    <input type="date"
                           name="deadline"
                           class="border p-2 w-full rounded">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Pihak Pertama
                    </label>

                    <input type="text"
                           name="pihak_pertama"
                           class="border p-2 w-full rounded">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Pihak Kedua
                    </label>

                    <input type="text"
                           name="pihak_kedua"
                           class="border p-2 w-full rounded">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Keterangan
                    </label>

                    <textarea name="keterangan"
                              rows="4"
                              class="border p-2 w-full rounded"></textarea>
                </div>

                <button type="submit"
                    class="bg-blue-900 text-white px-4 py-2 rounded">
                    Simpan Berita Acara
                </button>

            </form>

        </div>
    </div>
</x-app-layout>