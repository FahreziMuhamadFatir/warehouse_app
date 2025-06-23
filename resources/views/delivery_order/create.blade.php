
<!DOCTYPE html>
<html>
<head>
    <title>WAREHOUSE</title>
</head>
<body>
    <h1>FORM ADD DELIVERY OARDER</h1> <hr>
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

    <form action="{{ route('delivery_order.store') }}" method="POST">
        @csrf
        <label>No DO : </label><br>
        <input type="text" name="no_do"><br><br>

        <label>Tanggal : </label><br>
        <input type="date" name="tanggal"><br><br>

        <label>Tujuan : </label><br>
        <select name="tujuan" required>
            <option value="Stok">Stok</option>
            <option value="Jual">Jual</option>
            <option value="dll">dll</option>
        </select><br><br>

        <!-- <label>Status Pengambilan : </label><br>
        <select name="status_pengambilan" required>
            <option value="Sudah">Sudah</option>
            <option value="Belum">Belum</option>
        </select><br><br> -->

        <label>Keterangan : </label><br>
        <input type="text" name="keterangan"><br><br>


        <button type="submit" name="submit">SAVE</button>
    </form>
    <br>
    <a href="{{ route('delivery_order.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
</body>
</html>
