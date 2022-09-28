<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\URL;

use App\Models\Product;

use Illuminate\Support\Facades\Auth;

class ProductHelper { 

    public static function getAllProductData(){
		return Product::orderBy('id','desc')->paginate(3);
	}

    public static function getByProductId($id){
		return $getData = Product::where('id',$id)->first();
	}

	public static function getActiveProductData(){
		return Product::where('status','active')->orderBy('id','desc')->paginate(5);
	}
}