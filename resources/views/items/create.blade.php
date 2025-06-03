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
        <label>Nama Barang: </label><br>
        <input type="text" name="nama_barang"><br><br>

        <label>Kategori Barang: </label><br>
        <select name="category" required>
            <option value=" ">Choose type</option>
                @foreach ($categories  as $item) { ?>
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
        </select><br><br>

        <label>Ketebalan: </label><br>
        <input type="number" name="ketebalan_barang"><br><br>

        <button type="submit" name="submit">SAVE</button>
    </form>
    <br>
    <a href="{{ route('items.index') }}">Kembali</a>
</body>
</html>
