<?php

namespace App\Helpers;

use App\Models\Orderproduct;

use App\Models\Product;

use Illuminate\Support\Facades\Auth;

class OrderProductHelper
{

	public static function getOrderProduct()
	{
		$user = Auth::user();
		$getData = Orderproduct::select('orderproducts.*', 'product.product_name', 'product.profileimage')
			->leftjoin('product', 'product.id', '=', 'orderproducts.product_id')
			->leftjoin('orders', 'orders.id', '=', 'orderproducts.order_id')
			->where('orders.user_id', $user->id)
			->get();
		return $getData;
	}
	public static function getUserOrderProductList()
	{
		$getData = Orderproduct::select('orderproducts.*', 'product.product_name', 'users.name')
			->leftjoin('product', 'product.id', '=', 'orderproducts.product_id')
			->leftjoin('orders', 'orders.id', '=', 'orderproducts.order_id')
			->leftjoin('users', 'users.id', '=', 'orders.user_id')
			->where('product.status', 'active')
			->paginate(5);
		return $getData;
	}
	public static function getTopProductList()
	{
		$getData = Orderproduct::leftjoin('product', 'product.id', '=', 'orderproducts.product_id')
			->selectRaw('orderproducts.*, COALESCE(sum(orderproducts.quantity),0) total,product.product_name,product.price')
			->groupBy('orderproducts.product_id')
			->orderBy('total', 'desc')
			->where('product.status', 'active')
			->take(10)
			->get();
		return $getData;
	}
}
