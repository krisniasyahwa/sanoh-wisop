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
        // dd($documents);  // Verifikasi bahwa data sudah diambil dengan benar

        // Mengirim data ke view 'home'
        return view('home', compact('documents'));
    }


    // Menampilkan form untuk menambah dokumen baru
    public function uploadFile(Request $request)
{
    // Validasi input
    $request->validate([
        'doc_partno' => 'required|string|max:255',
        'doc_type' => 'required|in:WI,SOP,SPIS,SPSS',
        'doc_name' => 'required|file|mimes:pdf,doc,docx,xlsx|max:2048',
        'doc_rev' => 'required|string|max:10',
        'doc_effective_date' => 'required|date',
        'doc_expired_date' => 'required|date|after_or_equal:doc_effective_date',
        'doc_status' => 'required|string|max:50',
        'doc_customer' => 'required|string|max:255',
        'doc_dept' => 'required|string|max:255',
    ]);

    // Menyimpan file ke folder 'documents' di storage dan mendapatkan path-nya
    $filePath = $request->file('doc_name')->store('documents');

    // Membuat data baru di tabel `documents`
    Document::create([
        'doc_partno' => $request->doc_partno,
        'doc_type' => $request->doc_type,
        'doc_path' => $filePath,
        'doc_rev' => $request->doc_rev,
        'doc_effective_date' => $request->doc_effective_date,
        'doc_expired_date' => $request->doc_expired_date,
        'doc_status' => $request->doc_status,
        'doc_customer' => $request->doc_customer,
        'doc_dept' => $request->doc_dept,
    ]);

    // Redirect dengan pesan sukses
    return back()->with('success', 'File berhasil diupload dan disimpan.');
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
        $docPartNo = $request->input('doc_partno');
        $document = Document::where('doc_partno', $docPartNo)->first();

        if ($document) {
            return response()->json([
                'success' => true,
                'doc_path' => asset("pdf/{$document->doc_path}") // Pastikan `doc_path` berisi nama file PDF yang disimpan di folder 'public/pdf/'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Document not found'
            ]);
        }
    }
}
