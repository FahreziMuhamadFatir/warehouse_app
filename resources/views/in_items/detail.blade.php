@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Bongkaran Barang Masuk</h2>
    <p><strong>No Surat Jalan:</strong> {{ $in->no_surat_jalan }}</p>
    <p><strong>Tanggal Masuk:</strong> {{ $in->tanggal_masuk }}</p>
    <p><strong>Status:</strong>
        <span class="badge bg-{{ $in->status === 'done' ? 'success' : 'warning' }}">
            {{ strtoupper($in->status) }}
        </span>
    </p>

    @if ($in->status === 'done')
        <div class="alert alert-success mt-3">
            <strong>INFO:</strong> Bongkaran ini sudah diselesaikan. Item tidak dapat diubah.
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <hr>

    <h4>Daftar Barang Masuk</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Jumlah per Palet</th>
                @if ($in->status === 'draft')
                    <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($InItem as $item)
                <tr>
                    <td>{{ $item->item->nama_barang ?? 'Item hilang' }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->item->jumlah_per_palet ?? '-' }}</td>
                    @if ($in->status === 'draft')
                        <td>
                            <a href="{{ route('in_items.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('in_items.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus item ini?')">Hapus</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $in->status === 'draft' ? 4 : 3 }}">Belum ada item ditambahkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($in->status === 'draft')
        <a href="{{ route('in_items.create', $in->id) }}" class="btn btn-primary">Tambah Item</a>

        <form action="{{ route('barang_masuk.update_status', $in->id) }}" method="POST" class="mt-3">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-success" onclick="return confirm('Set bongkaran ini menjadi FINAL? Setelah ini tidak bisa diubah.')">
                Selesaikan Bongkaran
            </button>
        </form>
    @else
        <button class="btn btn-secondary mt-3" disabled>Status Sudah DONE</button>
    @endif

    <a href="{{ route('barang_masuk.index') }}" class="btn btn-secondary mt-3">← Kembali ke Daftar Bongkaran</a>
</div>
@endsection
