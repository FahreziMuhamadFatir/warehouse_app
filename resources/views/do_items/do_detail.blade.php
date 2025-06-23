@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Delivery Order</h2>
    <p><strong>No DO:</strong> {{ $do->no_do }}</p>
    <p><strong>Tanggal:</strong> {{ $do->tanggal }}</p>
    <p><strong>Tujuan:</strong> {{ $do->tujuan }}</p>
    <p><strong>Status:</strong>
        <span class="badge bg-{{ $do->status_pengambilan === 'out' ? 'success' : 'warning' }}">
            {{ strtoupper($do->status_pengambilan ?? 'draft') }}
        </span>
    </p>
    <p><strong>Keterangan:</strong> {{ $do->keterangan }}</p>

    @if ($do->status_pengambilan === 'out')
        <div class="alert alert-success mt-3">
            <strong>INFO:</strong> DO ini sudah diselesaikan. Item tidak dapat diubah.
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <hr>

    <h4>Daftar Barang Keluar</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                @if ($do->status_pengambilan !== 'out')
                    <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($do->doItems as $item)
                <tr>
                    <td>{{ $item->item->nama_barang ?? '-' }}</td>
                    <td>{{ $item->jumlah }}</td>
                    @if ($do->status_pengambilan !== 'out')
                        <td>
                            <a href="{{ route('do_items.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('do_items.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus item ini?')">Hapus</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $do->status_pengambilan !== 'out' ? 3 : 2 }}">Belum ada item ditambahkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($do->status_pengambilan !== 'out')
        <a href="{{ route('do_items.create', $do->id) }}" class="btn btn-primary">Tambah Item</a>

        <form action="{{ route('delivery_order.update_status', $do->id) }}" method="POST" class="mt-3">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-success" onclick="return confirm('Yakin finalisasi dan keluarkan stok?')">
                Finalisasi & Keluarkan Stok
            </button>
        </form>
    @else
        <button class="btn btn-secondary mt-3" disabled>Status Sudah OUT</button>
    @endif

    <a href="{{ route('delivery_order.index') }}" class="btn btn-secondary mt-3">← Kembali ke List DO</a>
</div>
@endsection
