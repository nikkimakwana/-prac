@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Product</div>

                <div class="card-body">
                    <a href="{{route('admin')}}" style="color:green;font-size:20px;">Back To Dashboard</a>
                </div>

                <a href="{{route('product.create')}}"><button>Add Product</button></a><br>

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
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (count($productData) > 0)
                                @php $i = 1 + (($productData->currentPage() - 1) * $productData->perPage()); @endphp
                                @foreach ($productData as $row)
                                <tr>
                                     <td>{{$i}}</td>
                                     <td><img src="{{$row->profileimage}}" height="30px"  width="30px"></td>
                                     <td>{{$row->product_name}}</td>
                                     <td>{{$row->quantity}}</td>
                                     <td>{{$row->price}}</td>
                                     <td>
                                        <a href="{{route('product.edit',$row->id)}}"><i class="fa fa-edit"></i>Edit</a>
                                        {!! Form::open(['method' => 'DELETE','route' => ['product.destroy', $row->id],'id'=>"delete_prod"]) !!}
                                       <button type="button" title="Delete" class="delete_prod">Delete</button>														
                                       {!! Form::close() !!}		
                                     </td>
                                </tr>
                                @php $i++; @endphp
                                @endforeach
                            @else
                            <tr>
                                <td colspan="6">
                                    <center><b>Data not found</b></center>
                                </td>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="pull-right pegination-margin">
                             {{ $productData->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo URL::to('/') ?>/assets/js/jquery.min.js"></script>
<script src="{{ asset('assets/admin/toastr/js/toastr.min.js') }}"></script>
<link href="<?php echo URL::to('/') ?>/assets/plugins/sweetalert2/sweetalert2.css" rel="stylesheet" type="text/css">
<script src="<?php echo URL::to('/') ?>/assets/plugins/sweetalert2/sweetalert2.min.js"></script>    
<script>
$('.delete_prod').on('click',function(e){
   e.preventDefault();
   var form = $(this).parents('form');
   Swal.fire({
      title: 'Are you sure you want to delete this product?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
   }).then((result) => {
      if (result.value) {
         form.submit();
      }
   });
});
</script>
@endsection
