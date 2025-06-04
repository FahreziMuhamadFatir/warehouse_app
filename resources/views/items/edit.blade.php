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

        <label>Kategori:</label><br>
        <select name="category_id">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
            </option>
            @endforeach
            </select><br><br>
        <label>kode barang</label><br>
        <input type="number" name="ketebalan_barang" value="{{ $item->ketebalan_barang }}"><br><br>

        <button type="submit">Update</button>
    </form>
    <br>
    <a href="{{ route('items.index') }}">Kembali</a>
</body>
</html>
