@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Item pada DO #{{ $doItem->do_id }}</h2>

    <form action="{{ route('do_items.update', $doItem->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="item_id" class="form-label">Barang</label>
            <select name="item_id" class="form-select" required>
                @foreach(\App\Models\Item::all() as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $doItem->item_id ? 'selected' : '' }}>
                        {{ $item->nama_barang }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $doItem->jumlah }}" required>
        </div>

        <input type="hidden" name="do_id" value="{{ $doItem->do_id }}">

        <button type="submit" class="btn btn-primary">Update Item</button>
        <a href="{{ route('do_items.detail', $doItem->do_id) }}" class="btn btn-secondary">Kembali</a>
    </form>


</div>
@endsection
