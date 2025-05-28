<!-- resources/views/items/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Data Items</title>
</head>
<body>
    <h1>Daftar Item</h1>

    <a href="{{ route('items.create') }}">Tambah Item</a>
    <br><br>

    @if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>kode barang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->category_id }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>
                    <a href="{{ route('items.edit', $item->id) }}">Edit</a> |
                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
