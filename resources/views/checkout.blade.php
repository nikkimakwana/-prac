@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Checkout Detail</div>
                @if(Session::has('success'))
                <div class="alert alert-info alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>{{ Session::get('success') }}
                </div>
                @endif
                @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>{{ Session::get('error') }}
                </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <table id="" class="table table-bordered">
                            <thead>
                                <tr>
                                    <p colspan="4">User Name: {{$userName}}</p>
                                    <p>Email : {{$userEmail}}</p>
                                </tr>
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total Payable</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($checkoutData) > 0)
                                @foreach ($checkoutData as $row)
                                <tr>
                                    <td><img src="{{$row->profileimage}}" height="100px" width="100px"></td>
                                    <td>{{$row->product_name}}</td>
                                    <td>{{$row->quantity}}</td>
                                    <td>{{$row->total}}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" style="padding-left:450px;">
                                        <a href="{{route('home')}}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                                        <a href="{{route('stripe')}}"><button class="btn btn-success">Payment</button></a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection