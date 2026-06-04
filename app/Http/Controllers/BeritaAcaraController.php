<?php

namespace App\Http\Controllers;

use App\Models\Brd;
use App\Models\BeritaAcara;
use Illuminate\Http\Request;

class BeritaAcaraController extends Controller
{
    public function create($brdId)
    {
        if (auth()->user()->role != 'engineering') {
            abort(403);
        }

        $brd = Brd::findOrFail($brdId);

        if ($brd->status_final != 'approved') {
            return redirect()->route('brd.index');
        }

        return view('berita-acara.create', compact('brd'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role != 'engineering') {
            abort(403);
        }

        $ba = BeritaAcara::create([
            'brd_id'        => $request->brd_id,
            'nomor_ba'      => $request->nomor_ba,
            'nama_project'  => $request->nama_project,
            'customer'      => $request->customer,
            'tanggal_ba'    => $request->tanggal_ba,
            'deadline'      => $request->deadline,
            'pihak_pertama' => $request->pihak_pertama,
            'pihak_kedua'   => $request->pihak_kedua,
            'keterangan'    => $request->keterangan,
        ]);

        return redirect()->route('ba.index');
    }

    public function show($id)
    {
        $ba = BeritaAcara::findOrFail($id);

        return view('berita-acara.show', compact('ba'));
    }

    public function dokumen($id)
    {
    $ba = BeritaAcara::findOrFail($id);

    return view('berita-acara.dokumen', compact('ba'));
    }

    public function index()
    {
        $beritaAcaras = BeritaAcara::with('brd')->latest()->get();

        return view('berita-acara.index', compact('beritaAcaras'));
    }

    public function approvalFinance(Request $request, $id)
    {
    $ba = BeritaAcara::findOrFail($id);

    $ba->status = $request->status;
    $ba->notes_finance = $request->notes_finance;

    $ba->save();

    return redirect()->route('ba.index');
    }

    public function destroy($id)
{
    if (auth()->user()->role != 'engineering') {
        abort(403);
    }

    $ba = BeritaAcara::findOrFail($id);
    $ba->delete();

    return redirect()->route('ba.index');
}

public function update(Request $request, $id)
{
    $ba = BeritaAcara::findOrFail($id);

    $ba->update([
        'nomor_ba'      => $request->nomor_ba,
        'nama_project'  => $request->nama_project,
        'customer'      => $request->customer,
        'tanggal_ba'    => $request->tanggal_ba,
        'deadline'      => $request->deadline,
        'pihak_pertama' => $request->pihak_pertama,
        'pihak_kedua'   => $request->pihak_kedua,
        'keterangan'    => $request->keterangan,
    ]);

    return redirect()->route('ba.index');
}
}