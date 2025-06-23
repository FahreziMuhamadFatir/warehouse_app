<!DOCTYPE html>
<html>
<head>
    <title>WAREHOUSE</title>
</head>
<body>
    <h1>FORM ADD DO ITEM </h1> <hr>

    <form action="{{ route('do_items.store', ['do'=>$do->id]) }}" method="POST">
        @csrf
        <!-- <input type="hidden" name="do_id" value="{{ $do->id }}"> -->
        <p>No DO: <strong>{{ $do->no_do }}</strong></p>
        <p>Tanggal: <strong>{{ $do->tanggal }}</strong></p>
        <p>Tujuan: <strong>{{ $do->tujuan }}</strong></p>

        <table id = "doItemsTable" border="1">
            <thead>
                <tr>
                    <th width="200px">Barang</th>
                    <th>Jumlah</th>
                    <th width="100px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- baris pertama -->
                 <tr>
                    <td>
                        <!-- Pilih Barang <br> -->
                        <select name="items[0][item_id]" class="select2" style="width: 250px;" required data-placeholder="Pilih Barang">
                            <option></option>
                            @foreach ($doItem as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select><br>
                    </td>
                    <td style="width:80px"><input type="number" name="items[0][jumlah]" min="1"required></td>
                    <td><button type="button" onclick="removeRow(this)">Delete</button></td>
                </tr>
            </tbody>
        </table>
        <button type="button" onclick="addRow()">+ Tambah Barang</button>
        <br><br>
        <button type="submit">Simpan Barang</button>
    </form>

    <br>
    <a href="{{ route('delivery_order.create') }}" class="btn btn-secondary mt-3">← Kembali</a>

    <!-- jQuery (wajib sebelum Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <script>
        let rowIndex=1;

        // Blade akan nge-loop dan hasilkan satu string panjang berisi semua <option>
        const itemOptions = `<option></option>{!!
            collect($doItem)->map(function($item) {
                return "<option value='{$item->id}'>{$item->nama_barang}</option>";
            })->implode('')
        !!}`;

        function addRow(){
            let newRow = `
            <tr>
                <td>
                    <select name="items[${rowIndex}][item_id]" class="select2" style="width:250px;" required>
                        ${itemOptions}
                    </select>
                </td>
                <td><input type="number" name="items[${rowIndex}][jumlah]" min="1" required></td>
                <td><button type="button" onclick="removeRow(this)">Delete</button></td>
            </tr>
            `;

            // append ke tbody
            $('#doItemsTable tbody').append(newRow);
            $('#doItemsTable tbody .select2').last().select2({ // inisialisasi ulang hanya yang baru
                placeholder: "Cari Barang..",
                allowClear: true
            }); //refresh select2
            rowIndex++;
        }

        function removeRow(button){
            $(button).closest('tr').remove();
        }

        $(document).ready(function (){
            $('.select2').select2({
                placeholder: "Cari Barang..",
                allowClear: true
            });
        });
    </script>
</body>
</html>
