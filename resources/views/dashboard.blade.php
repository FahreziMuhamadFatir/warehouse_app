@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Welcome, Admin</h3>
</div>

<!-- You Need to Hire Section -->
<!-- <div class="row mb-4">
    @foreach(['Report', 'Front Developers', 'UI/UX Designer', 'iOS Developer', 'Android Developer'] as $role)
    <div class="col-md-2 col-6 mb-3">
        <div class="card hover-animate">
            <div class="card-body text-center">
                <p class="card-text">{{ $role }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div> -->

@php
$menu = [
        'Category' => route('category.index'),
        'Item' => route('items.index'),
        'Barang Masuk' => route('barang_masuk.index'),
        'Barang Keluar' => route('delivery_order.index'),
    ];
@endphp

<div class="row mb-4">
    @foreach($menu as $label => $url)
    <div class="col-md-2 col-6 mb-3">
        <a href="{{ $url }}" class="card hover-animate text-decoration-none w-100" style="display: block;">
            <div class="card-body text-center">
                <p class="card-text mb-0 text-dark">{{ $label }}</p>
            </div>
        </a>
    </div>
    @endforeach
</div>

<!-- Recruitment Progress -->
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Daily Summary</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>NO DO</th>
                    <th>item name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach([1,2,3,4,5] as $i)
                <tr>
                    <td>0001</td>
                    <td>no item</td>
                    <td><span class="badge bg-success">Done</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
