@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="card-body">
                    <a href="{{ route('product.index') }}" style="color:green;font-size:20px;">Product</a><br>
                    <a href="{{ route('user-order-list') }}" style="color:green;font-size:20px;">Users Order List</a><br>
                    <a href="{{ route('top-selling-product') }}" style="color:green;font-size:20px;">Top Selling Product</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
