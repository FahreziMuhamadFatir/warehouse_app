@extends('layouts.app')

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Delivery Order</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('delivery_order.update', $deliveryOrder->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="no_do" class="form-label">No DO</label>
                    <input type="text" class="form-control" id="no_do" name="no_do" value="{{ old('no_do', $deliveryOrder->no_do) }}" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $deliveryOrder->tanggal) }}" required>
                </div>

                <div class="mb-3">
                    <label for="tujuan" class="form-label">Tujuan</label>
                    <select name="tujuan" id="tujuan" class="form-select" required>
                        <option value="Stok" {{ old('tujuan', $deliveryOrder->tujuan) == 'Stok' ? 'selected' : '' }}>Stok</option>
                        <option value="Jual" {{ old('tujuan', $deliveryOrder->tujuan) == 'Jual' ? 'selected' : '' }}>Jual</option>
                        <option value="dll"  {{ old('tujuan', $deliveryOrder->tujuan) == 'dll' ? 'selected' : '' }}>dll</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan', $deliveryOrder->keterangan) }}">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('delivery_order.index') }}" class="btn btn-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
