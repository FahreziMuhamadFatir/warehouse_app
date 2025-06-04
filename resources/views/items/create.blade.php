<!-- resources/views/items/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>WAREHOUSE</title>
</head>
<body>
    <h1>FORM ADD ITEM</h1>

    <form action="{{ route('items.store') }}" method="POST">
        @csrf
        <label>Nama:</label><br>
        <input type="text" name="nama_barang"><br><br>

        <label for="category_id">Category:</label><br>
        <select name="category_id" id="category_id">
        <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
            </select><br><br>

        <label>Ketebalan Barang:</label><br>
        <input type="number" name="ketebalan_barang"><br><br>

        <button type="submit" name="submit">SAVE</button>
    </form>

    <br>
    <a href="{{ route('items.index') }}">Kembali</a>
</body>
</html>
