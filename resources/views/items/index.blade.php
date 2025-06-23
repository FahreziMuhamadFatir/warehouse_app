@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Daftar Item</h2>
        <a href="{{ route('items.create') }}" class="btn btn-primary">+ Tambah Item</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead style="background-color: #3498db; color: #ffffff;">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Ketebalan Barang (mm)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ ($items->currentPage() - 1) * $items->perPage() + $loop->iteration }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->category->name ?? '-' }}</td>
                        <td>{{ $item->ketebalan_barang }}</td>
                        <td>
                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Data item belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination dan Tombol Kembali --}}
    <div class="d-flex justify-content-between align-items-center mt-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">← Kembali ke Dashboard</a>
        <div>
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection
