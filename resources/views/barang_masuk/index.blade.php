@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Daftar Barang Masuk</h2>
        <a href="{{ route('barang_masuk.create') }}" class="btn btn-primary">+ Tambah Barang Masuk</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead style="background-color: #3498db; color: #ffffff;">
                <tr>
                    <th>No</th>
                    <th>Kode Bongkaran</th>
                    <th>Tanggal Masuk</th>
                    <th>No Surat Jalan</th>
                    <th>Status</th>
                    <th>Summary</th>
                    <th>Keterangan</th>
                    <th>Created At</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangMasuk as $data)
                    <tr>
                        <td>{{ ($barangMasuk->currentPage() - 1) * $barangMasuk->perPage() + $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('in_items.in_detail', $data->id) }}" class="btn btn-sm btn-outline-primary">
                                ID #{{ $data->id }}
                            </a>
                        </td>
                        <td>{{ $data->tanggal_masuk }}</td>
                        <td>{{ $data->no_surat_jalan }}</td>
                        <td>
                            @if ($data->status === 'done')
                                <span class="badge bg-success">DONE</span>
                            @else
                                <span class="badge bg-warning text-dark">DRAFT</span>
                            @endif
                        </td>
                        <td>{{ $data->summary }}</td>
                        <td>{{ $data->keterangan }}</td>
                        <td>{{ $data->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <a href="{{ route('barang_masuk.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('barang_masuk.destroy', $data->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Data barang masuk belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-between align-items-center mt-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">← Kembali ke Dashboard</a>
        <div>
            {{ $barangMasuk->links() }}
        </div>
    </div>
</div>
@endsection
