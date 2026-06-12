<?php

namespace App\Http\Controllers;

use App\Models\Brd;
use App\Models\BeritaAcara;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $sort = $request->sort ?? 'latest';

        $totalBrd = Brd::count();
        $totalBa = BeritaAcara::count();
        $totalInvoice = Invoice::count();

        $totalDokumen = $totalBrd + $totalBa + $totalInvoice;

        $onProgress = Brd::where('status_final', 'pending')->count()
            + BeritaAcara::where('status', 'pending')->count()
            + Invoice::where('status', 'pending')->count();

        $selesai = Brd::where('status_final', 'approved')->count()
            + BeritaAcara::where('status', 'approved')->count()
            + Invoice::where('status', 'lunas')->count();

        $rejected = Brd::where('status_final', 'rejected')
            ->orWhere('status_final', 'revision')
            ->count()
            + BeritaAcara::where('status', 'rejected')->count();

        $pendingEngineering = Brd::where('status_engineering', 'pending')->count();

        $pendingFinance = Brd::where('status_engineering', 'approved')
            ->where('status_finance', 'pending')
            ->count();

        $pendingSales = Invoice::where('status', 'pending')->count();

        $brds = Brd::query()
    ->selectRaw("
        'BRD' as jenis,
        id,
        nomor_brd as nomor,
        judul as nama_project,
        client as customer,
        status_final as status,
        status_engineering,
        status_finance,
        deadline,
        created_at
    ")
    ->get();

$bas = BeritaAcara::query()
    ->selectRaw("'BA' as jenis, id, nomor_ba as nomor, nama_project, customer, status, deadline, created_at")
    ->get();

$invoices = Invoice::with('beritaAcara')
    ->get()
    ->map(function ($invoice) {
        return (object) [
            'jenis' => 'Invoice',
            'id' => $invoice->id,
            'nomor' => $invoice->nomor_invoice,
            'nama_project' => $invoice->beritaAcara->nama_project ?? '-',
            'customer' => $invoice->beritaAcara->customer ?? '-',
            'status' => $invoice->status,
            'deadline' => $invoice->deadline_pembayaran,
            'created_at' => $invoice->created_at,
        ];
    });
        $dokumenProyek = $brds->concat($bas)->concat($invoices);

        if ($search) {
            $dokumenProyek = $dokumenProyek->filter(function ($item) use ($search) {
                return str_contains(strtolower($item->nama_project), strtolower($search))
                    || str_contains(strtolower($item->customer), strtolower($search));
            });
        }

        if ($sort == 'oldest') {
            $dokumenProyek = $dokumenProyek->sortBy('created_at');
        } elseif ($sort == 'az') {
            $dokumenProyek = $dokumenProyek->sortBy('nama_project');
        } elseif ($sort == 'za') {
            $dokumenProyek = $dokumenProyek->sortByDesc('nama_project');
        } else {
            $dokumenProyek = $dokumenProyek->sortByDesc('created_at');
        }

        return view('dashboard.index', compact(
            'totalDokumen',
            'onProgress',
            'selesai',
            'rejected',
            'totalBrd',
            'totalBa',
            'totalInvoice',
            'pendingSales',
            'pendingEngineering',
            'pendingFinance',
            'dokumenProyek',
            'search',
            'sort'
        ));
    }
}