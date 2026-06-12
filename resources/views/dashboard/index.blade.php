<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-900 text-white py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl uppercase">
                    Dashboard Monitoring Dokumen
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">

        <div class="flex justify-end mb-4">
    <button onclick="exportDashboardPDF()"
            class="bg-red-600 text-white px-5 py-2 rounded-xl font-semibold hover:bg-red-700">
        Export PDF
    </button>
</div>

<div id="dashboardExportArea">

        {{-- SUMMARY CARD --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <div class="bg-blue-900 text-white rounded-3xl shadow p-6">
        <p class="uppercase text-xs tracking-widest">
            Total Dokumen
        </p>

        <h1 class="text-5xl font-bold mt-4">
            {{ $totalDokumen }}
        </h1>
    </div>

    <div class="bg-white rounded-3xl shadow p-6">
        <p class="uppercase text-xs tracking-widest text-orange-600">
            On Progress
        </p>

        <h1 class="text-5xl font-bold mt-4 text-orange-500">
            {{ $onProgress }}
        </h1>
    </div>

    <div class="bg-white rounded-3xl shadow p-6">
        <p class="uppercase text-xs tracking-widest text-green-600">
            Selesai
        </p>

        <h1 class="text-5xl font-bold mt-4 text-green-500">
            {{ $selesai }}
        </h1>
    </div>

    <div class="bg-white rounded-3xl shadow p-6">
        <p class="uppercase text-xs tracking-widest text-red-600">
            Rejected
        </p>

        <h1 class="text-5xl font-bold mt-4 text-red-500">
            {{ $rejected }}
        </h1>
    </div>

</div>

{{-- GRAFIK DASHBOARD --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">

    {{-- STATUS DOKUMEN --}}
    <div class="bg-white rounded-3xl shadow p-6">
        <h3 class="font-bold text-lg text-blue-900 mb-4">
            Status Dokumen
        </h3>

        <div class="h-64">
            <canvas id="statusDokumenChart"></canvas>
        </div>
    </div>

    {{-- JUMLAH DOKUMEN --}}
    <div class="bg-white rounded-3xl shadow p-6">
        <h3 class="font-bold text-lg text-blue-900 mb-4">
            Jumlah Dokumen
        </h3>

        <div class="h-64">
            <canvas id="jumlahDokumenChart"></canvas>
        </div>
    </div>

    {{-- BOTTLENECK --}}
    <div class="bg-white rounded-3xl shadow p-6">
        <h3 class="font-bold text-lg text-blue-900 mb-4">
            Bottleneck Workflow
        </h3>

        <div class="h-64">
            <canvas id="bottleneckChart"></canvas>
        </div>
    </div>

</div>

{{-- TABEL DOKUMEN PROYEK --}}
<div class="bg-white rounded-3xl shadow p-6 mt-6">

    <h3 class="font-bold text-2xl text-blue-900 mb-6">
        Dokumen Proyek
    </h3>

    <form method="GET"
          action="{{ route('dashboard') }}"
          class="grid md:grid-cols-3 gap-4 mb-6">

        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-blue-900 mb-2">
                Pencarian
            </label>

            <input type="text"
                   name="search"
                   value="{{ $search }}"
                   placeholder="Nama proyek atau customer..."
                   class="w-full rounded-xl border-gray-300">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-blue-900 mb-2">
                Sorting
            </label>

            <select name="sort"
                    class="w-full rounded-xl border-gray-300">

                <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>
                    Terbaru → Terlama
                </option>

                <option value="oldest" {{ $sort == 'oldest' ? 'selected' : '' }}>
                    Terlama → Terbaru
                </option>

                <option value="az" {{ $sort == 'az' ? 'selected' : '' }}>
                    A-Z
                </option>

                <option value="za" {{ $sort == 'za' ? 'selected' : '' }}>
                    Z-A
                </option>

            </select>
        </div>

        <div class="flex items-end">
            <button
                class="w-full bg-blue-900 text-white rounded-xl py-3 font-semibold">
                Terapkan Filter
            </button>
        </div>

    </form>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>
                <tr class="bg-gray-100 text-blue-900 uppercase text-xs tracking-widest">

                    <th class="text-left px-4 py-4">
                        Jenis Dokumen
                    </th>

                    <th class="text-left px-4 py-4">
                        Detail Proyek
                    </th>

                    <th class="text-left px-4 py-4">
                        Nomor Dokumen
                    </th>

                    <th class="text-left px-4 py-4">
                        Status Dokumen
                    </th>

                    <th class="text-left px-4 py-4">
                        Deadline
                    </th>

                    <th class="text-left px-4 py-4">
                        Aksi Dokumen
                    </th>

                </tr>
            </thead>

            <tbody>

@forelse($dokumenProyek as $dokumen)

    <tr class="border-b">

        {{-- JENIS DOKUMEN --}}
        <td class="px-4 py-4">
            @if($dokumen->jenis == 'BRD')
                <span class="bg-slate-100 text-slate-700 px-3 py-1 rounded-full text-xs font-semibold">
                    BRD
                </span>
            @elseif($dokumen->jenis == 'BA')
                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-semibold">
                    BA
                </span>
            @elseif($dokumen->jenis == 'Invoice')
                <span class="bg-zinc-100 text-zinc-700 px-3 py-1 rounded-full text-xs font-semibold">
                    Invoice
                </span>
            @endif
        </td>

        {{-- DETAIL PROYEK --}}
        <td class="px-4 py-4">
            <div class="font-semibold text-blue-900">
                {{ $dokumen->nama_project }}
            </div>

            <div class="text-xs text-gray-500">
                {{ $dokumen->customer }}
            </div>
        </td>

        {{-- NOMOR DOKUMEN --}}
        <td class="px-4 py-4">
            {{ $dokumen->nomor }}
        </td>

        {{-- STATUS DOKUMEN --}}
        <td class="px-4 py-4">
            @if($dokumen->jenis == 'BRD')

                @if($dokumen->status == 'approved')
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                        Approved
                    </span>

                @elseif($dokumen->status == 'rejected' || $dokumen->status == 'revision')
                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                        Rejected
                    </span>

                @elseif($dokumen->status_engineering == 'pending' && $dokumen->status_finance == 'pending')
                    <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-semibold">
                        Pending
                    </span>

                @elseif($dokumen->status_engineering == 'approved' && $dokumen->status_finance == 'pending')
                    <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-semibold">
                        Pending Finance
                    </span>

                @elseif($dokumen->status_engineering == 'pending' && $dokumen->status_finance == 'approved')
                    <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-semibold">
                        Pending Engineering
                    </span>
                @endif

            @elseif($dokumen->status == 'pending')
                <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-semibold">
                    Pending
                </span>

            @elseif($dokumen->status == 'approved')
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                    Approved
                </span>

            @elseif($dokumen->status == 'rejected')
                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                    Rejected
                </span>

            @elseif($dokumen->status == 'lunas')
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                    Selesai
                </span>
            @endif
        </td>

        {{-- DEADLINE --}}
        <td class="px-4 py-4">
            @if($dokumen->deadline)
                {{ \Carbon\Carbon::parse($dokumen->deadline)->format('d M Y') }}
            @else
                <span class="text-gray-400">-</span>
            @endif
        </td>

        {{-- AKSI DOKUMEN --}}
        <td class="px-4 py-4">

            @if(auth()->user()->role == 'sales' && $dokumen->jenis == 'BRD')

                <form action="{{ route('brd.destroy', $dokumen->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus BRD ini?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="bg-red-100 text-red-700 px-4 py-2 rounded-xl text-xs font-semibold hover:bg-red-200">
                        Delete
                    </button>
                </form>

            @elseif(auth()->user()->role == 'engineering' && $dokumen->jenis == 'BA')

                <form action="{{ route('ba.destroy', $dokumen->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus BA ini?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="bg-red-100 text-red-700 px-4 py-2 rounded-xl text-xs font-semibold hover:bg-red-200">
                        Delete
                    </button>
                </form>

            @elseif(auth()->user()->role == 'finance' && $dokumen->jenis == 'Invoice')

                <form action="{{ route('invoice.destroy', $dokumen->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus Invoice ini?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="bg-red-100 text-red-700 px-4 py-2 rounded-xl text-xs font-semibold hover:bg-red-200">
                        Delete
                    </button>
                </form>

            @else
                <span class="text-gray-400">-</span>
            @endif

        </td>

    </tr>
                @empty

                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-500">
                            Belum ada dokumen proyek.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>

new Chart(
    document.getElementById('statusDokumenChart'),
    {
        type: 'doughnut',
        data: {
            labels: ['On Progress', 'Selesai', 'Rejected'],
            datasets: [{
                data: [
                    {{ $onProgress }},
                    {{ $selesai }},
                    {{ $rejected }}
                ],
                backgroundColor: [
                    '#f59e0b',
                    '#22c55e',
                    '#ef4444'
                ],
                borderWidth: 0
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    }
);

new Chart(
    document.getElementById('jumlahDokumenChart'),
    {
        type: 'bar',
        data: {
            labels: ['BRD', 'BA', 'Invoice'],
            datasets: [{
                label: 'Jumlah Dokumen',
                data: [
                    {{ $totalBrd }},
                    {{ $totalBa }},
                    {{ $totalInvoice }}
                ],
                backgroundColor: '#1e3a8a',
                borderRadius: 10
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    }
);

new Chart(
    document.getElementById('bottleneckChart'),
    {
        type: 'bar',
        data: {
            labels: [
                'Pending Sales',
                'Pending Engineering',
                'Pending Finance'
            ],
            datasets: [{
                label: 'Jumlah Pending',
                data: [
                    {{ $pendingSales }},
                    {{ $pendingEngineering }},
                    {{ $pendingFinance }}
                ],
                backgroundColor: '#93c5fd',
                borderRadius: 10
            }]
        },
        options: {
            maintainAspectRatio: false,
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    }
);

async function exportDashboardPDF() {
    const { jsPDF } = window.jspdf;
    const dashboard = document.getElementById('dashboardExportArea');

    const canvas = await html2canvas(dashboard, {
        scale: 2,
        useCORS: true
    });

    const imgData = canvas.toDataURL('image/png');

    const pdf = new jsPDF('p', 'mm', 'a4');

    const pdfWidth = 210;
    const pageHeight = 297;
    const imgWidth = pdfWidth;
    const imgHeight = canvas.height * imgWidth / canvas.width;

    let heightLeft = imgHeight;
    let position = 0;

    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
    heightLeft -= pageHeight;

    while (heightLeft > 0) {
        position = heightLeft - imgHeight;
        pdf.addPage();
        pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
        heightLeft -= pageHeight;
    }

    pdf.save('dashboard-monitoring-dokumen.pdf');
}

</script>

</x-app-layout>