<?php

namespace App\Http\Controllers;

use App\Models\Brd;
use App\Models\BrdFile;
use Illuminate\Http\Request;

class BrdController extends Controller
{
    public function index()
    {
        $brds = Brd::latest()->get();
        return view('brd.index', compact('brds'));
    }

    public function create()
    {
        if (auth()->user()->role != 'sales') {
            abort(403);
        }

        return view('brd.create');
    }

    public function store(Request $request)
{
    if (auth()->user()->role != 'sales') {
        abort(403);
    }

    $request->validate([
        'nomor_brd' => 'required',
        'judul' => 'required',
        'deskripsi' => 'required',
        'tanggal_upload' => 'required',
        'deadline' => 'required',
        'files' => 'required',
        'files.*' => 'file|mimes:pdf,doc,docx|max:5120',
    ]);

    $brd = Brd::create([
        'nomor_brd' => $request->nomor_brd,
        'client' => $request->client,
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'tanggal_upload' => $request->tanggal_upload,
        'deadline' => $request->deadline,
        'sales_id' => auth()->id(),
    ]);

    foreach ($request->file('files') as $file) {
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('brd_files'), $namaFile);

        BrdFile::create([
            'brd_id' => $brd->id,
            'nama_file' => $namaFile,
            'path_file' => 'brd_files/' . $namaFile,
        ]);
    }

    return redirect()->route('brd.index');
}

    public function show($id)
    {
        $brd = Brd::with('files', 'sales')->findOrFail($id);

        return view('brd.show', compact('brd'));
    }

    public function approvalEngineering(Request $request, $id)
    {
        if (auth()->user()->role != 'engineering') {
            abort(403);
        }

        $request->validate([
            'status_engineering' => 'required|in:approved,rejected',
            'notes_engineering' => 'nullable|string',
        ]);

        $brd = Brd::findOrFail($id);

        $brd->status_engineering = $request->status_engineering;
        $brd->notes_engineering = $request->notes_engineering;

        if ($request->status_engineering == 'rejected') {
            $brd->status_final = 'revision';
        }

        if ($brd->status_engineering == 'approved' && $brd->status_finance == 'approved') {
            $brd->status_final = 'approved';
        }

        $brd->save();

        return redirect()->route('brd.index');
    }
    public function approvalFinance(Request $request, $id)
{
    if (auth()->user()->role != 'finance') {
        abort(403);
    }

    $request->validate([
        'status_finance' => 'required|in:approved,rejected',
        'notes_finance' => 'nullable|string',
    ]);

    $brd = Brd::findOrFail($id);

    if ($brd->status_engineering != 'approved') {
        return redirect()->route('brd.index');
    }

    $brd->status_finance = $request->status_finance;
    $brd->notes_finance = $request->notes_finance;

    if ($request->status_finance == 'rejected') {
        $brd->status_final = 'revision';
    }

    if ($brd->status_engineering == 'approved' && $brd->status_finance == 'approved') {
        $brd->status_final = 'approved';
    }

    $brd->save();

    return redirect()->route('brd.index');
}

public function destroy($id)
{
    if (auth()->user()->role != 'sales') {
        abort(403);
    }

    $brd = Brd::findOrFail($id);
    $brd->delete();

    return redirect()->route('brd.index');
}

public function update(Request $request, $id)
{
    if (auth()->user()->role != 'sales') {
        abort(403);
    }

    $brd = Brd::findOrFail($id);

    $brd->update([
        'nomor_brd' => $request->nomor_brd,
        'client' => $request->client,
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'tanggal_upload' => $request->tanggal_upload,
        'deadline' => $request->deadline,
    ]);

    return redirect()->route('brd.index');
}
}