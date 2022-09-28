@extends('layouts.app')

@section('content')

<style>
    .errmsg {
        color: Red;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Product</div>

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
                        {!! Form::open(['route' => ['product.store'],'id' => 'form_submit','method' => 'post','class' => 'parsley-examples','files' => true,'enctype' => 'multipart/form-data','data-parsley-validate']); !!}
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('name','Product Name',['class' => 'col-form-label']); !!}<span class="text-danger">*</span>
                            </div>
                            <div class="col-md-10">
                                {!! Form::text('name','',[
                                'id' => 'name',
                                'placeholder' => 'Name',
                                'class' => 'form-control',
                                'required' => 'required',
                                'data-parsley-required-message' => 'Please enter Product Name',
                                'data-parsley-maxlength' => 25,
                                'data-parsley-maxlength-message' => 'Name should not allow to add more than 25 character',
                                'data-parsley-errors-container' => '#name_error',
                                ]); !!}
                                <span class="errmsg" id="name_error">{{$errors->first('name')}}</span>
                            </div>
                        </div><br />

                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('price','Price',['class' => 'col-form-label']); !!}<span class="text-danger">*</span>
                            </div>
                            <div class="col-md-10">
                                {!! Form::text('price','',[
                                'id' => 'price',
                                'placeholder' => 'Price',
                                'class' => 'form-control',
                                'required' => 'required',
                                'data-parsley-required-message' => 'Please enter Price',
                                'data-parsley-type' => 'digits',
                                'data-parsley-type-message' => 'Price only digits allowed',
                                'data-parsley-min' => '1',
                                'data-parsley-min-message' => 'Price should be greater than or equal to 1',
                                'data-parsley-errors-container' => '#price_error',
                                ]); !!}
                                <span class="errmsg" id="price_error">{{$errors->first('price')}}</span>
                            </div>
                        </div><br />

                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('quantity','Quantity',['class' => 'col-form-label']); !!}<span class="text-danger">*</span>
                            </div>
                            <div class="col-md-10">
                                {!! Form::text('quantity','',[
                                'id' => 'quantity',
                                'placeholder' => 'Quantity',
                                'class' => 'form-control',
                                'required' => 'required',
                                'data-parsley-required-message' => 'Please enter Quantity',
                                'data-parsley-type' => 'digits',
                                'data-parsley-type-message' => 'Quantity only digits allowed',
                                'data-parsley-min' => '1',
                                'data-parsley-min-message' => 'Price should be greater than or equal to 1',
                                'data-parsley-errors-container' => '#quantity_error',
                                ]); !!}
                                <span class="errmsg" id="quantity_error">{{$errors->first('quantity')}}</span>
                            </div>
                        </div><br />

                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('description','Description',['class' => 'col-form-label']); !!}<span class="text-danger">*</span>
                            </div>
                            <div class="col-md-10">
                                {!! Form::textarea('description',null,[
                                'class'=>'form-control',
                                'rows' => 2,
                                'cols' => 40,
                                'placeholder' => 'Description',
                                'required' => 'required',
                                'data-parsley-required-message' => 'Please enter Product Description',
                                'data-parsley-errors-container' => '#description_error',
                                ]);
                                !!}
                                <span class="errmsg" id="name_error">{{$errors->first('description')}}</span>
                            </div>
                        </div><br />

                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('status','Status',['class' => 'col-form-label']); !!}<span class="text-danger">*</span>
                            </div>
                            <div class="col-md-10">
                                {!! Form::select('status[]', array('active' => 'Active', 'deactive' => 'Deactive'), null, [
                                'placeholder' => 'Select status',
                                'class'=>'form-control select2-dropdown',
                                'data-toggle' => 'select2',
                                'id' => 'status',
                                'required' => 'required',
                                'data-parsley-required-message' => 'Please select Status',
                                'data-parsley-errors-container' => '#status_error',
                                ]) !!}
                                <span class="errmsg" id="status_error">{{$errors->first('status')}}</span>
                            </div>
                        </div><br />

                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('profileimage','Image',['class' => 'col-form-label']); !!}
                            </div>
                            <div class="col-md-3">
                                {!! Form::file('profileimage',[
                                'id' => 'profileimage',
                                'class' => 'dropify',
                                'data-default-file' => asset('assets/admin/images/defaultimage.png'),
                                'data-parsley-profileimageextension' => 'jpeg,jpg,png',
                                'data-parsley-errors-container' => '#profileimage_error',
                                ]); !!}
                                <span class="errmsg" id="profileimage_error">{{$errors->first('profileimage')}}</span>
                            </div>
                        </div><br />

                        <div class="form-group row justify-content-end">
                            <div class="col-md-10">
                                {!! Form::submit('Submit',['id' => 'submit','class' => 'btn btn-primary waves-effect waves-light mr-1']); !!}
                                <a href="{{ route('product.index')}}" class="btn btn-secondary waves-effect">Cancel</a>
                            </div>
                        </div>
                        {!! Form::close(); !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo URL::to('/') ?>/assets/js/jquery.min.js"></script>
<script>
    $("#form_submit").submit(function() {
        var form = $(this);
        form.parsley().validate();
        if (form.parsley().isValid()) {
            $("#submit").prop("disabled", true);
        }
    });
</script>
<!-- Parsley -->
<script>
    window.ParsleyConfig = {
        errorsWrapper: '<div></div>',
        errorTemplate: '<span class="errmsg parsley"></span>',
        errorClass: 'has-error',
        successClass: 'has-success'
    };
</script>
<script src="{{ asset('assets/admin/parsley_js/dist/parsley.js') }}"></script>
<script src="{{ asset('assets/admin/parsley_js/dist/parsley.min.js') }}"></script>
<script src="{{ asset('assets/admin/toastr/js/toastr.min.js') }}"></script>

@endsection