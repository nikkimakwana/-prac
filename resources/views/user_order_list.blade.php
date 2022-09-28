@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Order</div>

                <div class="card-body">
                    <a href="{{route('admin')}}" style="color:green;font-size:20px;">Back To Dashboard</a>
                </div>

                <div class="row">
                    <div class="col-12">
                        <table id="" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (count($getData) > 0)
                                @php $i = 1 + (($getData->currentPage() - 1) * $getData->perPage()); @endphp
                                @foreach ($getData as $row)
                                <tr>
                                     <td>{{$i}}</td>
                                     <td>{{ucFirst($row->name)}}</td>
                                     <td>{{$row->product_name}}</td>
                                     <td>{{$row->quantity}}</td>
                                     <td>{{$row->total}}</td>
                                    
                                </tr>
                                @php $i++; @endphp
                                @endforeach
                            @else
                            <tr>
                                <td colspan="5">
                                    <center><b>Data not found</b></center>
                                </td>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="pull-right pegination-margin">
                             {{ $getData->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo URL::to('/') ?>/assets/js/jquery.min.js"></script>
<script src="{{ asset('assets/admin/toastr/js/toastr.min.js') }}"></script>

@endsection
