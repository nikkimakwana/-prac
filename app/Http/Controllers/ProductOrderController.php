<?php

namespace App\Http\Controllers;

use App\Helpers\OrderProductHelper;
use App\Models\Order;
use App\Models\Orderproduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductOrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userName = $user->name;
        $userEmail = $user->email;
        $checkoutData = OrderProductHelper::getOrderProduct();
       
        return view('checkout',compact('checkoutData','userName','userEmail'));
    }
    public function checkoutProcess()
    {
        $user = Auth::user();
        $cart = session()->get('cart');
        
        if(!empty($cart)){
            $total = 0;
            $qty = 0;
            $insertOrderArray = array(
                'user_id' => $user->id,
                'order_no' => '#' . rand(10,100000),
                'order_date' =>date('Y-m-d H:i:s'),
            );
            $insert = Order::create($insertOrderArray);

            foreach(session('cart') as $id => $value){

                $totalProdPrice = $value['price'] * $value['quantity'];
                
                $insertProductArray = array(
                    'order_id' => $insert->id,
                    'product_id' => $value['pid'],
                    'total' =>$totalProdPrice,
                    'quantity' =>$value['quantity'],
                );
                $insertp = Orderproduct::create($insertProductArray);
            }
            if ($insertp) {
                Session::forget('cart');
                Session::flash('success', 'Successfully placed order!');
                return redirect('checkout');
            }else {
                Session::flash('error', 'Sorry, something went wrong. Please try again.');
                return redirect('home');
            }
        }else{
            Session::flash('error', 'Sorry, something went wrong. Please try again.');
            return redirect('home');
        }
    }

    public function userOrderList()
    {
        $getData = OrderProductHelper::getUserOrderProductList();
        return view('user_order_list',compact('getData'));
    }
    public function topSellingProduct()
    {
        $getData = OrderProductHelper::getTopProductList();
        return view('top_selling_product',compact('getData'));
    }
}
