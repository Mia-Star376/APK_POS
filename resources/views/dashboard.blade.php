@extends('layouts.app')

@section('title', 'Login')

@section('content')

@include('layouts.navbar')

    <div class="container-fluid py-4 px-4">

        <h4 class="mb-5 text-center">
            Ringkasan Hari Ini
            <small class="text-muted fw-normal">
                ({{ $tanggalHariIni->translatedFormat('l, d F Y') }})
            </small>
        </h4>

        @can('viewAny', App\Models\User::class)
        <h6 class="text-uppercase text-muted mb-3 text-center">Today's Sales</h6>
        <div class="row g-3 mb-5">
            <div class="col-md-6">
                <div class="border rounded p-4 bg-white">
                    <div class="text-muted small">Total Nilai Penjualan Hari Ini</div>
                    <div class="fs-5 fw-semibold">Rp {{ number_format($ringkasan['total_penjualan']) }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded p-4 bg-white">
                    <div class="text-muted small">Jumlah Transaksi Hari Ini</div>
                    <div class="fs-5 fw-semibold">{{ $ringkasan['total_transaksi'] }}</div>
                </div>
            </div>
        </div>

        <h6 class="text-uppercase text-muted mb-3 text-center">Cash & Payment Status</h6>
        <div class="row g-3 mb-5">
            <div class="col-md-6">
                <div class="border rounded p-4 bg-white">
                    <div class="text-muted small">Total Pembayaran Tunai</div>
                    <div class="fs-5 fw-semibold">Rp {{ number_format($ringkasan['total_cash']) }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded p-4 bg-white">
                    <div class="text-muted small">Total Pembayaran Non-Tunai</div>
                    <div class="fs-5 fw-semibold">Rp {{ number_format($ringkasan['total_non_tunai']) }}</div>
                </div>
            </div>
        </div>
        @endcan

        <h6 class="text-uppercase text-muted mb-3 text-center">Critical Inventory Status</h6>
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="border rounded p-4 bg-white">
                    <div class="small fw-semibold mb-2">Daftar Produk Stok Rendah</div>
                    <div class="rounded-3 overflow-hidden border">
                    <table class="table table-sm table-bordered mb-0">
                        <thead>
                            <tr class="text-muted">
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkStokRendah as $index => $produk)
                            <tr>
                                <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->stok }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-muted text-center small">
                                    Seluruh produk berada dalam stok aman.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                    {{ $produkStokRendah->links() }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="border rounded p-4 bg-white">
                    <div class="small fw-semibold mb-2">Produk Habis Stok</div>
                    <div class="rounded-3 overflow-hidden border">
                    <table class="table table-sm table-bordered mb-0">
                        <thead>
                            <tr class="text-muted">
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkStokHabis as $index => $produk)
                            <tr>
                                <td>{{ $produkStokHabis->firstItem() + $index }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->stok }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-muted text-center small">
                                    Seluruh produk berada dalam kondisi stok aman.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                    {{ $produkStokHabis->links() }}
                </div>
            </div>
        </div>

        <h6 class="text-uppercase text-muted mb-3 text-center">Best Seller Products</h6>
        <div class="row mb-5">
            <div class="col-12">
                <div class="border rounded p-4 bg-white">
                    <div class="rounded-3 overflow-hidden border">
                    <table class="table table-sm table-bordered mb-0">
                        <thead>
                            <tr class="text-muted">
                                <th scope="col">Nama</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Unit Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkTerlaris as $produk)
                            <tr>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->stok }}</td>
                                <td>{{ $produk->total_terjual }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-muted text-center small">
                                    Seluruh produk berada dalam kondisi stok aman.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection