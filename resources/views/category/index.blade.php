<!-- resources/views/items/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>CATEGORY</title>
</head>
<body>
    <h1>Daftar Category</h1> <hr>

    <a href="{{ route('category.create') }}">Tambah Category</a>
    <br><br>

    @if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Kode barang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($category as $cate)
            <tr>
                <td>{{ $cate->id }}</td>
                <td>{{ $cate->name }}</td>
                <td>{{ $cate->jenis }}</td>
                <td>{{ $cate->kode }}</td>
                <td>
                    <a href="{{ route('category.edit', $cate->id) }}">Edit</a> |
                    <form action="{{ route('category.destroy', $cate->id) }}" method="POST" style="display:inline;">
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
