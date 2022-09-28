@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome {{Auth::user()->name}}!</div><br>
                <div class="card-header">Products</div>

                <div class="row">
                    <div class="col-12">
                        <table id="" class="table ">
                           
                            <tbody>
                            @if (count($productData) > 0)
                                @php $i = 1 + (($productData->currentPage() - 1) * $productData->perPage()); @endphp
                                @foreach ($productData as $row)
                                <tr>
                                     <td><img src="{{$row->profileimage}}" height="100px"  width="100px"></td>
                                     <td><a href="{{route('product-detail',$row->id)}}"><strong>{{$row->product_name}}</strong></a></br>
                                     {{$row->description}}</br>
                                     $ {{$row->price}}</br>
                                     <a href="{{ route('add-to-cart', $row->id) }}"><button>Add To Cart</button></a>
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
