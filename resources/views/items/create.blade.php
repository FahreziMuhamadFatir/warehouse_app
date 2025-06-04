<!-- resources/views/items/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Item</title>
</head>
<body>
    <h1>Tambah Item</h1>

    <form action="{{ route('items.store') }}" method="POST">
        @csrf
       <label>Nama:</label><br>
        <input type="text" name="nama_barang"><br><br>

        <label>Category ID:</label><br>
        <input type="number" name="category_id"><br><br>

        <label>Kode Barang:</label><br>
        <input type="number" name="kode_barang"><br><br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('items.index') }}">Kembali</a>
</body>
</html>
