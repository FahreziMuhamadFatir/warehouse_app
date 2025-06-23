@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Daftar Kategori</h2>
        <a href="{{ route('category.create') }}" class="btn btn-primary">+ Tambah Category</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead style="background-color: #3498db; color: #ffffff;">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Kode</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($category as $cate)
                    <tr>
                        <td>{{ ($category->currentPage() - 1) * $category->perPage() + $loop->iteration }}</td>
                        <td>{{ $cate->name }}</td>
                        <td>{{ $cate->jenis }}</td>
                        <td>{{ $cate->kode }}</td>
                        <td>
                            <a href="{{ route('category.edit', $cate->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('category.destroy', $cate->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Data kategori belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination dan Tombol Kembali --}}
    <div class="d-flex justify-content-between align-items-center mt-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">← Kembali ke Dashboard</a>
        <div>
            {{ $category->links() }}
        </div>
    </div>
</div>
@endsection
