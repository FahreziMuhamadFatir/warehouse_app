<!-- resources/views/items/edit.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Item</title>
</head>
<body>
    <h1>Edit Item</h1>

    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nama:</label><br>
        <input type="text" name="nama_barang" value="{{ $item->nama_barang }}"><br><br>

        <label>Kategori ID:</label><br>
        <input type="number" name="category_id" value="{{ $item->category_id }}"><br><br>

        <label>kode barang</label><br>
        <input type="number" name="kode_barang" value="{{ $item->kode_barang }}"><br><br>

        <button type="submit">Update</button>
    </form>
    <br>
    <a href="{{ route('items.index') }}">Kembali</a>
</body>
</html>
