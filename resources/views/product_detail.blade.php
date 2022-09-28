@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Product Detail</div>

                <div class="row">
                    <div class="col-12">
                        <table id="" class="table ">
                            <tbody>
                                <tr>
                                    <td><img src="{{$product->profileimage}}" height="100px" width="100px"></td>
                                    <td><strong>{{$product->product_name}}</strong></br>
                                        {{$product->description}}</br>
                                        $ {{$product->price}}</br>
                                        <a href="{{ route('add-to-cart', $product->id) }}"><i class="fa fa-edit"></i><button>Add Cart</button></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
    $('.delete_prod').on('click', function(e) {
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