<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\BeritaAcara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('beritaAcara.brd')->latest()->get();

        return view('invoice.index', compact('invoices'));
    }

    public function create($baId)
    {
        if (auth()->user()->role != 'finance') {
            abort(403);
        }

        $ba = BeritaAcara::with('brd')->findOrFail($baId);

        if ($ba->status != 'approved') {
            return redirect()->route('ba.index');
        }

        return view('invoice.create', compact('ba'));
    }

    public function store(Request $request)
{
    if (auth()->user()->role != 'finance') {
        abort(403);
    }

    DB::transaction(function () use ($request) {

        Invoice::create([
            'berita_acara_id' => $request->berita_acara_id,
            'nomor_invoice' => $request->nomor_invoice,
            'tanggal_invoice' => $request->tanggal_invoice,
            'deadline_pembayaran' => $request->deadline_pembayaran,
            'total_nominal' => $request->total_nominal,
            'dp_masuk' => $request->dp_masuk,
            'sisa_pembayaran' => $request->total_nominal - $request->dp_masuk,
            'keterangan' => $request->keterangan,
        ]);

    });

    return redirect()->route('invoice.index');
}

    public function show($id)
    {
        $invoice = Invoice::with('beritaAcara.brd')->findOrFail($id);

        return view('invoice.show', compact('invoice'));
    }

    public function dokumen($id)
    {
        $invoice = Invoice::with('beritaAcara.brd')->findOrFail($id);

        return view('invoice.dokumen', compact('invoice'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role != 'finance') {
            abort(403);
        }

        $invoice = Invoice::findOrFail($id);

        $invoice->update([
            'nomor_invoice' => $request->nomor_invoice,
            'tanggal_invoice' => $request->tanggal_invoice,
            'deadline_pembayaran' => $request->deadline_pembayaran,
            'total_nominal' => $request->total_nominal,
            'dp_masuk' => $request->dp_masuk,
            'sisa_pembayaran' => $request->total_nominal - $request->dp_masuk,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('invoice.index');
    }

    public function lunas($id)
    {
        if (auth()->user()->role != 'sales') {
            abort(403);
        }

        $invoice = Invoice::findOrFail($id);
        $invoice->status = 'lunas';
        $invoice->save();

        return redirect()->route('invoice.index');
    }

    public function destroy($id)
    {
        if (auth()->user()->role != 'finance') {
            abort(403);
        }

        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('invoice.index');
    }
}