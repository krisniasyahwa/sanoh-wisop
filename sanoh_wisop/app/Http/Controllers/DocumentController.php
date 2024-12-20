<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DocumentController extends Controller
{
    // Menampilkan daftar dokumen (khusus Admin)
    public function index()
    {
        $documents = Document::with('masterItem')->paginate(6);

        // Update status setiap dokumen berdasarkan tanggal expired
        foreach ($documents as $document) {
            $currentDate = Carbon::now();
            $expiredDate = Carbon::parse($document->doc_expired_date);

            $document->doc_status = ($expiredDate >= $currentDate) ? 1 : 0;
        }

        // Mengirim data ke view 'home'
        return view('home', compact('documents'));
    }


    // Menampilkan form untuk menambah dokumen baru
    public function uploadFile(Request $request)
    {
        // Validasi input
        $request->validate([
            'doc_partno' => 'required',
            'doc_type' => 'required',
            'doc_name' => 'required|file',
            'doc_rev' => 'required',
            'doc_effective_date' => 'required|date',
            'doc_expired_date' => 'required|date',
            'doc_customer' => 'required',
            'doc_dept' => 'required',
        ]);

        // Tentukan tanggal kedaluwarsa dan tanggal sekarang
        $expiredDate = Carbon::parse($request->doc_expired_date);
        $currentDate = Carbon::now();

        // Tentukan status berdasarkan perbandingan tanggal, dalam bentuk integer
        $status = ($expiredDate >= $currentDate) ? 1 : 0;

        // Simpan dokumen baru
        $document = new Document();
        $document->doc_partno = $request->doc_partno;
        $document->doc_type = $request->doc_type;
        $document->doc_rev = $request->doc_rev;
        $document->doc_effective_date = $request->doc_effective_date;
        $document->doc_expired_date = $request->doc_expired_date;
        $document->doc_customer = $request->doc_customer;
        $document->doc_dept = $request->doc_dept;

        // Proses file upload
        if ($request->hasFile('doc_name')) {
            $file = $request->file('doc_name');
            $destinationPath = public_path('pdf');
            $fileName = $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $document->doc_path = 'pdf/' . $fileName;
        }

        // Tentukan status dokumen
        $document->doc_status = $status; // Simpan status sebagai integer

        // Simpan dokumen ke database
        $document->save();

        return redirect()->route('documents')->with('success', 'Document uploaded successfully!');
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

    // Memvaldoc_idasi dan menampilkan dokumen setelah scan
    public function show(Request $request)
    {
        // Ambil dokumen berdasarkan `doc_partno` dari input
        $doc_partno = $request->input('doc_partno');
        $document = Document::with('masterItem')->where('doc_partno', $doc_partno)->first();

        if (!$document) {
            // Jika dokumen tidak ditemukan
            return redirect()->back()->with('error', 'Dokumen tidak ditemukan.');
        }

        // Hitung status dokumen berdasarkan tanggal expired
        $currentDate = Carbon::now();
        $expiredDate = Carbon::parse($document->doc_expired_date);
        $doc_status = ($expiredDate >= $currentDate) ? 1 : 0;

        // Periksa apakah dokumen memiliki status aktif (1)
        if ($doc_status === 1) {
            // Kirim data dokumen ke view jika aktif
            return view('', compact('document'));
        } else {
            // Jika dokumen tidak aktif, beri pesan error
            return redirect()->back()->with('error', 'Dokumen sudah kedaluwarsa dan tidak dapat di-scan.');
        }
    }

    // Mengambil data dokumen
    public function getDocument(Request $request)
    {
        $docPartNo = $request->input('doc_partno');
        $document = Document::where('doc_partno', $docPartNo)->first();

        if ($document) {
            // Hitung status dokumen berdasarkan tanggal expired
            $currentDate = Carbon::now();
            $expiredDate = Carbon::parse($document->doc_expired_date);
            $doc_status = ($expiredDate >= $currentDate) ? 1 : 0;

            if ($doc_status === 0) {
                // Jika dokumen kedaluwarsa, jangan kirim doc_path
                return response()->json([
                    'success' => false,
                    'message' => 'Dokumen telah kedaluwarsa, silakan hubungi admin/leader produksi ',
                ]);
            }

            // Jika dokumen masih aktif
            return response()->json([
                'success' => true,
                'doc_path' => asset($document->doc_path),

            ]);
        } else {
            // Jika dokumen tidak ditemukan
            return response()->json([
                'success' => false,
                'message' => 'Dokumen tidak ditemukan.',
            ]);
        }
    }
}
