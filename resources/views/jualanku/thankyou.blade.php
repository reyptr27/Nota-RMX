@extends('layouts.app')

@section('title', 'Terimakasih')

@section('content')
<nav class="navbar navbar-default" role="navigation">
  <div class="navbar-header">
    <a class="navbar-brand" href="https://dnevensurabaya.com">
    <img src="/img/logo.png" width="160" height="65" alt="">
    </a>
  </div>
</nav>

<div class="container terimakasih">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->

                    <div class="card-body">
                    <div class="thankyou">

                        <div class="smaller">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 60 60" style="enable-background:new 0 0 60 60;" xml:space="preserve">
                            <path class="check" d="M40.61,23.03L26.67,36.97L13.495,23.788c-1.146-1.147-1.359-2.936-0.504-4.314
                            c3.894-6.28,11.169-10.243,19.283-9.348c9.258,1.021,16.694,8.542,17.622,17.81c1.232,12.295-8.683,22.607-20.849,22.042
                            c-9.9-0.46-18.128-8.344-18.972-18.218c-0.292-3.416,0.276-6.673,1.51-9.578"/>
                            </svg>
                        </div>  

                        <h2 style="text-align: center; font-weight: 500; margin-top: 50px;">Order Berhasil!</h2>
                        <p style="text-align: center;">Pesanan anda sedang diproses, Terimakasih telah berbelanja di D'NEVEN Bakehouse 😀
                        </p>

                            <div class="row justify-content-center">
                                <a href="{{ url('https://dnevensurabaya.com') }}" class="btn btn-primary mr-3 konfirmasi">Home Page</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')

@endsection