<!DOCTYPE html>
<html>
<head>
    <title>Edit Item Bongkaran</title>
</head>
<body>
    <h1>Edit Item Bongkaran</h1>
    <form action="{{ route('in_items.update', ['in_item' => $InItem->id]) }}" method="POST">

        @csrf
        @method('PUT')

        <label>Nama Barang:</label><br>
        <select name="item_id" required>
            @foreach (\App\Models\Item::all() as $item)
                <option value="{{ $item->id }}" {{ $item->id == $InItem->item_id ? 'selected' : '' }}>
                    {{ $item->nama_barang }}
                </option>
            @endforeach
        </select><br><br>

        <label>Jumlah:</label><br>
        <input type="number" name="jumlah" value="{{ $InItem->jumlah }}" required><br><br>

        <button type="submit">Update</button>
    </form>

    <br>
    <a href="{{ url()->previous() }}">← Kembali</a>
</body>
</html>
