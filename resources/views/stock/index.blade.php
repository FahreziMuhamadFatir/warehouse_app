@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Stok Saat Ini</h2>

    <div class="table-responsive mb-5">
        <table class="table table-bordered table-striped align-middle">
            <thead style="background-color: #3498db; color: #ffffff;">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Ketebalan</th>
                    <th>Total Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stok as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $s->item->nama_barang ?? '-' }}</td>
                        <td>{{ $s->item->ketebalan_barang ?? '-' }} mm</td>
                        <td>{{ $s->stok_total ?? 0 }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada data stok.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h2 class="mb-4">Log Perubahan Stok</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead style="background-color: #3498db; color: #ffffff;">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tipe</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logStok as $log)
                    <tr>
                        <td>{{ ($logStok->currentPage() - 1) * $logStok->perPage() + $loop->iteration }}</td>
                        <td>{{ $log->created_at->format('d-m-Y H:i') }}</td>
                        <td>{{ $log->item->nama_barang ?? '-' }}</td>
                        <td>
                            @if ($log->qty_masuk)
                                +{{ $log->qty_masuk }}
                            @elseif ($log->qty_keluar)
                                -{{ $log->qty_keluar }}
                            @else
                                0
                            @endif
                        </td>
                        <td>
                            @if ($log->tipe === 'Masuk')
                                <span class="badge bg-success">Masuk</span>
                            @else
                                <span class="badge bg-danger">Keluar</span>
                            @endif
                        </td>
                        <td>{{ $log->keterangan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada log stok.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            {{ $logStok->links() }}
        </div>
    </div>
</div>
@endsection
