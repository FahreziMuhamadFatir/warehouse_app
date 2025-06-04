<!DOCTYPE html>
<html>
<head>
    <title>WAREHOUSE</title>
</head>
<body>
    <h1>FORM EDIT BONGKARAN</h1> <hr>

    <form action="{{ route('barang_masuk.update', $barangMasuk->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Item:</label><br>
        <select name="item_id" required>
            @foreach ($items as $item)
                <option value="{{ $item->id }}" {{ $barangMasuk->item_id == $item->id ? 'selected' : '' }}>
                    {{ $item->nama_barang }}
                </option>
            @endforeach
        </select><br><br>

        <label>Tanggal Masuk:</label><br>
        <input type="date" name="tanggal_masuk" value="{{ $barangMasuk->tanggal_masuk }}" required><br><br>

        <label>No Surat Jalan:</label><br>
        <input type="text" name="no_surat_jalan" value="{{ $barangMasuk->no_surat_jalan }}"><br><br>

        <label>Summary:</label><br>
        <input type="text" name="summary" value="{{ $barangMasuk->summary }}"><br><br>

        <label>Qty:</label><br>
        <input type="number" name="jumlah_masuk" value="{{ $barangMasuk->jumlah_masuk }}" required><br><br>

        <label>Jumlah per Palet:</label><br>
        <input type="number" name="jumlah_per_palet" value="{{ $barangMasuk->jumlah_per_palet }}"><br><br>

        <label>Keterangan:</label><br>
        <textarea name="keterangan" rows="3" cols="30">{{ $barangMasuk->keterangan }}</textarea><br><br>

        <button type="submit" name="submit">SAVE</button>
    </form>

    <br>
    <a href="{{ route('barang_masuk.index') }}">Kembali</a>
</body>
</html>
