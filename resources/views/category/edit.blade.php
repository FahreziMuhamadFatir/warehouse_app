
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

    <form action="{{ route('category.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Category: </label><br>
    <input type="text" name="name" value="{{ $category->name }}"><br><br>

    <label>Jenis: </label><br>
    <input type="text" name="jenis" value="{{ $category->jenis }}"><br><br>

    <label>Kode: </label><br>
    <input type="text" name="kode" value="{{ $category->kode }}"><br><br>

    <button type="submit">SAVE</button>
</form>
    <br>
    <a href="{{ route('category.index') }}">Kembali</a>
</body>
</html>
