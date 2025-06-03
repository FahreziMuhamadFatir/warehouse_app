
<!DOCTYPE html>
<html>
<head>
    <title>WAREHOUSE</title>
</head>
<body>
    <h1>FORM EDIT CATEGORY</h1> <hr>
        <!-- {{-- Menampilkan error validasi --}} -->
    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('category.update', $item->id) }}" method="POST">
        @csrf
        <label>Nama Barang: </label><br>
        <input type="text" name="name"><br><br>

        <!-- <label>Jenis Barang: </label><br>
        <input type="text" name="jenis"><br><br>

        <label>Kode Barang: </label><br>
        <input type="text" name="kode"><br><br> -->
    
        <button type="submit" name="submit">SAVE</button>
    </form>
    <br>
    <a href="{{ route('category.index') }}">Kembali</a>
</body>
</html>
