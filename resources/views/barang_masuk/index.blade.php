
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Barang Masuk</title>
</head>
<body>
    <h1>Daftar Barang Masuk</h1>
    <a href="{{ route('barang_masuk.create') }}">Tambah Barang Masuk</a>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Item</th>
            <th>Tanggal Masuk</th>
            <th>No Surat Jalan</th>
            <th>Summary</th>
            <th>Jumlah Masuk</th>
            <th>Jumlah per Palet</th>
            <th>Keterangan</th>
            <th>Created At</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($barangMasuk as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->item->nama_barang ?? 'Item hilang' }}</td>
                <td>{{ $data->tanggal_masuk }}</td>
                <td>{{ $data->no_surat_jalan }}</td>
                <td>{{ $data->summary }}</td>
                <td>{{ $data->jumlah_masuk }}</td>
                <td>{{ $data->jumlah_per_palet }}</td>
                <td>{{ $data->keterangan }}</td>
                <td>{{ $data->created_at->format('d-m-Y H:i') }}</td>
                <td>
                    <a href="{{ route('barang_masuk.edit', $data->id) }}">Edit</a> |
                    <form action="{{ route('barang_masuk.destroy', $data->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="11">Data barang masuk belum tersedia.</td>
            </tr>
        @endforelse
    </tbody>
</table>

    <br>

</body>
</html>
