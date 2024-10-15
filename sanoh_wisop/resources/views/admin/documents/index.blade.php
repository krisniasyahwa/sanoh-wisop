@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Dokumen</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Tambah Dokumen Baru</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Part Number</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $document)
                <tr>
                    <td>{{ $document->doc_id }}</td>
                    <td>{{ $document->doc_partno }}</td>
                    <td>{{ $document->doc_type }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $document->doc_id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.products.destroy', $document->doc_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus dokumen ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
