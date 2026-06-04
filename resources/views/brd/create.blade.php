<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-4 shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-sans antialiased text-lg font-semibold">
                    CREATE BUSINESS REQUIREMENT DOCUMENT
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w<div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">-4xl mx-auto bg-white p-6 rounded shadow">

            <form action="{{ route('brd.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label class="block mb-1 font-medium text-gray-700">
                    Nomor BRD
                </label>
                <input type="text"
       name="nomor_brd"
       class="border border-gray-300 rounded-lg p-2 w-full mb-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

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

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition duration-200">
                    Simpan
                </button>

            </form>

        </div>
    </div>
</x-app-layout>