<!DOCTYPE html>
<html>
<head>
    <title>WAREHOUSE</title>
</head>
<body>
    <h1>FORM ADD BONGKARAN</h1> <hr>

    <form action="{{ route('barang_masuk.store') }}" method="POST">
        @csrf

        <label>Tanggal Masuk:</label><br>
        <input type="date" name="tanggal_masuk" required><br><br>

        <label>No Surat Jalan:</label><br>
        <input type="text" name="no_surat_jalan"><br><br>

        <label>Summary:</label><br>
        <input type="text" name="summary"><br><br>

        <label>Keterangan:</label><br>
        <textarea name="keterangan" rows="3" cols="30"></textarea><br><br>

        <button type="submit" name="submit">SAVE</button>
    </form>

    <br>
    <a href="{{ route('barang_masuk.index') }}">Kembali</a>
</body>
</html>
