@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Dokumen Baru</h1>
    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="doc_partno">Part Number</label>
            <input type="text" name="doc_partno" id="doc_partno" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="doc_type">Jenis Dokumen</label>
            <select name="doc_type" id="doc_type" class="form-control" required>
                <option value="WI">WI</option>
                <option value="SOP">SOP</option>
                <option value="SPIS">SPIS</option>
                <option value="SPSS">SPSS</option>
            </select>
        </div>

        <div class="form-group">
            <label for="doc_path">Lokasi Dokumen</label>
            <input type="text" name="doc_path" id="doc_path" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
