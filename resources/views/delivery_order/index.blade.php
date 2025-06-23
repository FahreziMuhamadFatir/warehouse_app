@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Daftar Delivery Order</h2>
        <a href="{{ route('delivery_order.create') }}" class="btn btn-primary">+ Tambah DO</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead style="background-color: #3498db; color: #ffffff;">
                <tr>
                    <th>No</th>
                    <th>No DO</th>
                    <th>Tanggal</th>
                    <th>Tujuan</th>
                    <th>Status Pengambilan</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($deliveryOrder as $do)
                    <tr>
                        <td>{{ ($deliveryOrder->currentPage() - 1) * $deliveryOrder->perPage() + $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('do_items.detail', ['do' => $do->id]) }}" class="btn btn-sm btn-outline-primary">
                                {{ $do->no_do }}
                            </a>
                        </td>
                        <td>{{ $do->tanggal }}</td>
                        <td>{{ $do->tujuan }}</td>
                        <td>
                            @if ($do->status_pengambilan === 'out')
                                <span class="badge bg-success">OUT</span>
                            @elseif ($do->status_pengambilan === 'draft')
                                <span class="badge bg-warning text-dark">DRAFT</span>
                            @else
                                <span class="badge bg-secondary">-</span>
                            @endif
                        </td>
                        <td>{{ $do->keterangan }}</td>
                        <td>
                            <a href="{{ route('delivery_order.edit', $do->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('delivery_order.destroy', $do->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Data DO belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination dan Tombol Kembali --}}
    <div class="d-flex justify-content-between align-items-center mt-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">← Kembali ke Dashboard</a>
        <div>
            {{ $deliveryOrder->links() }}
        </div>
    </div>
</div>
@endsection
