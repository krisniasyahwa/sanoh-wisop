<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    // Menampilkan daftar dokumen (khusus Admin)
    public function index()
    {
        $documents = Document::with('masterItem')->get();
        return view('admin.documents.index', compact('documents'));
    }


    // Menampilkan form untuk menambah dokumen baru
    public function create()
    {
        return view('admin.documents.create');
    }

    // Menyimpan dokumen baru ke dalam database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doc_partno' => 'required|string|max:255',
            'doc_type' => 'required|in:WI,SOP,SPIS,SPSS',
            'doc_path' => 'required|string',
            // Validasi tambahan untuk field lain...
        ]);

        Document::create($validated);

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit dokumen
    public function edit($id)
    {
        $document = Document::with('masterItem')->findOrFail($id);
        return view('admin.documents.edit', compact('document'));
    }


    // Memperbarui data dokumen yang ada
    public function update(Request $request, $id)
    {
        $document = Document::with('masterItem')->findOrFail($id);
        $validated = $request->validate([
            'doc_effective_date' => 'required|date',
            'doc_expired_date' => 'required|date|after_or_equal:doc_effective_date',
        ]);

        $document->update($validated);

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil diperbarui');
    }

    // Menghapus dokumen
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $document->delete();

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil dihapus');
    }

    // Menampilkan halaman scan dokumen (untuk Warehouse)
    public function scan()
    {
        return view('warehouse.show'); //ganti
    }

    // Memvalidasi dan menampilkan dokumen setelah scan
    public function show(Request $request)
    {
        $doc_partno = $request->input('doc_partno');
        $document = Document::with('masterItem')->where('doc_partno', $doc_partno)->first();

        if ($document) {
            return view('warehouse.show', compact('document'));
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    // Mengambil data dokumen
    public function getDocument(Request $request)
{
    $doc_partno = $request->input('doc_partno');
    $document = Document::where('doc_partno', $doc_partno)->first();

    if ($document) {
        return response()->json(['success' => true, 'doc_path' => asset($document->doc_path)]);
    } else {
        return response()->json(['success' => false, 'message' => 'Document not found']);
    }
}

}
