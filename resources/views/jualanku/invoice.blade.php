@extends('layouts.app')

@section('title', 'Invoice')

@section('content')
<header>
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="https://dnevensurabaya.com">
                <img src="/img/logo.png" width="165" height="65" alt="">
            </a>
        </div>
    </nav>
</header>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Data Pesanan</div>

                <div class="card-body">
                    <div>

                    @foreach ($data as $object)
                        <div class="produk-header" style="margin-bottom: 50px;">
                            <div class="row">
                                <div class="col-7"> <span id="tgl">Tanggal Pesan :</span><br> <span id="tgl_data">{{ $object->created_at }}</span> </div>
                                <div class="col-5 pull-right"> <span id="no">No. Pesanan :</span><br> <span id="no_data">{{ $object->no }}</span> </div>
                            </div>
                        </div>
                        <div class="produk-body" style="margin-bottom: 20px;">
                            <div class="row">
                                <div class="col-7"><span><b>Nama Pemesan</b></span></div>
                                <div class="col-5 pull-right"><span>{{ $object->nama }}</span></div>
                            </div>
                            <div class="row">
                                <div class="col-7"><span>No. Handphone</span></div>
                                <div class="col-5 pull-right"><span>{{ $object->hp }}</span></div>
                            </div>
                            <div class="row">
                                <div class="col-7"><span>Alamat</span></div>
                                <div class="col-5 pull-right"><span>{{ $object->alamat }}</span></div>
                            </div>
                        </div>
                        
                        <div class="row produk">
                            <div class="col-md-10 tabel1">
                                <table class="table">
                                    <thead>
                                        <tr class="table-light">
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col">Harga</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                        @foreach ($pesanan as $item)
                                        <tr>
                                            <th scope="row">{{ $item->nama }}</th>
                                            <td>Rp. {{ str_replace(',', '.', number_format($item->harga)) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-2 tabel2">
                                <table class="table">
                                    <thead>
                                        <tr class="table-light">
                                            <th scope="col">Kuantitas</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                        @foreach ($qty as $kuantitas)
                                        <tr>
                                            <td>x{{ $kuantitas }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-md-6 align-self-end total">
                                <table class="table table-borderless ">
                                    <thead>
                                        
                                        <tr>
                                            <th scope="col">Total harga</th>
                                            <td>Rp. {{ str_replace(',', '.', number_format($totalsum)) }}</td>
                                        </tr>
                                        
                                    </thead>
                                </table>
                            </div>
                        </div>

                    @endforeach
                    
                    </div>
                    <div class="row justify-content-end">
                    <a href="{{ route('terimakasih') }}" id="konfirmasi-pesanan" class="btn btn-primary mr-3 konfirmasi">Konfirmasi Pesanan</a>
                    
                    </div>
                </div> 
            </div>
        </div> 
    </div>
</div>
@endsection

@section('extra-js')
<script>
    fbq('track', 'Purchase', {currency: "IDR", value: {{ $totalsum }}});
</script>
@endsection