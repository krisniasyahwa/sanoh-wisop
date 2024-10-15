@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Dokumen</h1>
    <form action="{{ route('admin.products.update', $document->doc_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="doc_partno">Part Number</label>
            <input type="text" name="doc_partno" id="doc_partno" class="form-control" value="{{ $document->doc_partno }}" required>
        </div>

        <div class="form-group">
            <label for="doc_type">Jenis Dokumen</label>
            <select name="doc_type" id="doc_type" class="form-control" required>
                <option value="WI" {{ $document->doc_type == 'WI' ? 'selected' : '' }}>WI</option>
                <option value="SOP" {{ $document->doc_type == 'SOP' ? 'selected' : '' }}>SOP</option>
                <option value="SPIS" {{ $document->doc_type == 'SPIS' ? 'selected' : '' }}>SPIS</option>
                <option value="SPSS" {{ $document->doc_type == 'SPSS' ? 'selected' : '' }}>SPSS</option>
            </select>
        </div>

        <div class="form-group">
            <label for="doc_path">Lokasi Dokumen</label>
            <input type="text" name="doc_path" id="doc_path" class="form-control" value="{{ $document->doc_path }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
