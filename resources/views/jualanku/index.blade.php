  
@extends('layouts.app')

@section('title', 'Jualanku')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->

                    <div class="card-body">
                        <livewire:products-qty-index></livewire:products-qty-index>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')

@endsection