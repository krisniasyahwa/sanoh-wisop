<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    // Menampilkan daftar dokumen (khusus Admin)
    public function index()
    {
        $documents = Document::with('masterItem')->paginate(6);
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

        // Ambil file dari request
        $file = $request->file('doc_name');

        // Tentukan nama file
        $fileName = time() . '-' . $file->getClientOriginalName();

        // Pastikan folder `public/pdf` ada
        if (!file_exists(public_path('pdf'))) {
            mkdir(public_path('pdf'), 0755, true);
        }

        // Pindahkan file ke folder public/pdf
        $file->move(public_path('pdf'), $fileName);

        // Simpan path ke database (gunakan relative path)
        Document::create([
            'doc_partno' => $request->doc_partno,
            'doc_type' => $request->doc_type,
            'doc_path' => 'pdf/' . $fileName, // Simpan path relatif
            'doc_rev' => $request->doc_rev,
            'doc_effective_date' => $request->doc_effective_date,
            'doc_expired_date' => $request->doc_expired_date,
            'doc_status' => $request->doc_status,
            'doc_customer' => $request->doc_customer,
            'doc_dept' => $request->doc_dept,
        ]);

        // Redirect dengan pesan sukses
        return back()->with('success', 'File berhasil diupload dan disimpan di public/pdf.');
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
   public function edit($doc_id)
{
    // Mencari dokumen berdasarkan doc_id
    $document = Document::findOrFail($doc_id);

    // Mengirim data dokumen ke view
    return view('layouts.partials.edit_file', compact('document'));

}

    // Memperbarui data dokumen yang ada
    public function update(Request $request, $doc_id)
    {
        $document = Document::findOrFail($doc_id); // Mendapatkan dokumen berdasarkan doc_id
        $document->doc_expired_date = $request->doc_expired_date; // Memperbarui expired date
        $document->save(); // Menyimpan perubahan

        return redirect()->route('documents')->with('success', 'Document updated successfully');
    }


    // Menghapus dokumen
    public function destroy($doc_id)
    {
        $document = Document::findOrFail($doc_id);
        $document->delete();

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil dihapus');
    }

    // Menampilkan halaman scan dokumen (untuk Warehouse)
    public function scan()
    {
        return view('warehouse.show'); //ganti
    }

    // Memvaldoc_idasi dan menampilkan dokumen setelah scan
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
                'doc_path' => asset($document->doc_path), // Gunakan path relatif dari database
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Document not found',
            ]);
        }
    }
}
