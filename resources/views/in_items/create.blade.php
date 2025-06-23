<!DOCTYPE html>
<html>
<head>
    <title>WAREHOUSE</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        td { padding: 5px; }
    </style>
</head>
<body>
    <h1>FORM ADD in ITEM </h1> <hr>

    <form action="{{ route('in_items.store', ['in'=>$in->id]) }}" method="POST" id="formAddItem">
        @csrf

        <p>No receive: <strong>{{ $in->no_in }}</strong></p>
        <p>Tanggal: <strong>{{ $in->tanggal }}</strong></p>
        <p>Tujuan: <strong>{{ $in->tujuan }}</strong></p>

        <table id="inItemsTable" border="1">
            <thead>
                <tr>
                    <th width="200px">Barang</th>
                    <th>Jumlah</th>
                    <th width="100px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="items[0][item_id]" class="select-barang" style="width: 250px;" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach ($InItem as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="items[0][jumlah]" min="1" required></td>
                    <td><button type="button" onclick="removeRow(this)">Hapus</button></td>
                </tr>
            </tbody>
        </table>

        <button type="button" onclick="addRow()">+ Tambah Barang</button>
        <br><br>
        <button type="submit">Simpan Barang</button>
    </form>

    <br>
    <a href="{{ route('barang_masuk.index') }}">Kembali</a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

    <script>
        let rowIndex = 1;

        const itemOptions = `@foreach ($InItem as $item)
            <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
        @endforeach`;

        function addRow() {
            let row = `
                <tr>
                    <td>
                        <select name="items[${rowIndex}][item_id]" class="select-barang" style="width: 250px;" required>
                            <option value="">-- Pilih Barang --</option>
                            ${itemOptions}
                        </select>
                    </td>
                    <td><input type="number" name="items[${rowIndex}][jumlah]" min="1" required></td>
                    <td><button type="button" onclick="removeRow(this)">Hapus</button></td>
                </tr>
            `;

            $('#inItemsTable tbody').append(row);
            $(`select[name="items[${rowIndex}][item_id]"]`).select2({
                placeholder: "Cari Barang...",
                allowClear: true
            });
            rowIndex++;
        }

        function removeRow(btn) {
            $(btn).closest('tr').remove();
        }

        $(document).ready(function () {
            $('.select-barang').select2({
                placeholder: "Cari Barang...",
                allowClear: true
            });
        });
    </script>
</body>
</html>
