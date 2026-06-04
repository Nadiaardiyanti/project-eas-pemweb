<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-900 text-white py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-sans antialiased text-lg font-semibold">
                    CREATE BUSINESS REQUIREMENT DOCUMENT
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

            <form action="{{ route('brd.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label>Nomor BRD</label>
                <input type="text" name="nomor_brd" class="border p-2 w-full mb-4">

                <label>Nama Client</label>
                <input type="text" name="client" class="border p-2 w-full mb-4">

                <label>Nama Project</label>
                <input type="text" name="judul" class="border p-2 w-full mb-4">

                <label>Deskripsi</label>
                <textarea name="deskripsi" class="border p-2 w-full mb-4"></textarea>

                <label>Tanggal Upload</label>
                <input type="date"
                 name="tanggal_upload"
                 value="{{ date('Y-m-d') }}"
                 readonly
                 class="border p-2 w-full mb-4">

                <label>Deadline Approval</label>
                <input type="date"
                 name="deadline"
                 class="border p-2 w-full mb-4">
  
                <label>Upload File BRD</label>
                <input type="file" name="files[]" class="border p-2 w-full mb-4" multiple>

                <small class="text-gray-500">
                    Bisa upload lebih dari 1 file (PDF, DOC, DOCX)
                </small>

                <br><br>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Simpan
                </button>

            </form>

        </div>
    </div>
</x-app-layout>