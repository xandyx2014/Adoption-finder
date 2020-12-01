@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary">{{ __('Dashboard') }}</div>

                <div class="card-body d-flex flex-wrap">
                    <div style="width: 250px" class="small-box bg-info mr-3 elevation-4">
                        <div class="inner">
                            <h5>Mascotas</h5>

                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    {{--{{ __('You are logged in!') }} {{ auth()->user()->name }}--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
