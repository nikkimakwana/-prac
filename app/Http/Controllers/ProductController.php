<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Helpers\ProductHelper;
use App\Helpers\imageUploadHelper;
use App\Models\Product;
use Illuminate\Support\Facades\URL;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['productData'] = ProductHelper::getAllProductData();
        return view('product/index',$data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation_data = array(
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'status' => 'required',
            'profileimage' => 'mimes:png,jpeg,jpg'
        );
        $status = implode(',',request('status'));
        $insertArray = array(
            'product_name' => request('name'),
            'description' => request('description'),
            'price' => request('price'),
            'status' =>$status,
            'quantity' =>request('quantity')
        );
        
        if ($request->hasFile('profileimage')) {
            if ($request->file('profileimage')->isValid()) {
                $insertArray['profileimage'] = imageUploadHelper::uploadFileWithPath($request->file('profileimage'),'upload');
            }
        }else{
            $insertArray['profileimage'] = URL::to('/') . '/upload_default/default_product.png';
        }
        $insert = Product::create($insertArray);
        if ($insert) {
            Session::flash('success', 'Product inserted successfully.');
            return redirect('product');
        }else {
            Session::flash('error', 'Sorry, something went wrong. Please try again.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['productData'] = ProductHelper::getByProductId($id);
        return view('product/edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation_data = array(
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'status' => 'required',
            'profileimage' => 'mimes:png,jpeg,jpg'
        );
        $status = implode(',',request('status'));
        $updateArray = array(
            'product_name' => request('name'),
            'description' => request('description'),
            'price' => request('price'),
            'status' =>$status,
            'quantity' =>request('quantity')
        );
        
        if ($request->hasFile('profileimage')) {
            if ($request->file('profileimage')->isValid()) {
                $updateArray['profileimage'] = imageUploadHelper::uploadFileWithPath($request->file('profileimage'),'upload');
            }
        }else {
            $updateArray['profileimage'] = request('old_profileimage');
        }
        $update = Product::where('id',$id)->update($updateArray);
        if ($update) {
            Session::flash('success', 'Product updated successfully.');
            return redirect('product');
        }else {
            Session::flash('error', 'Sorry, something went wrong. Please try again.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = Product::where('id',$id)->delete();
        if($prod){
            Session::flash('success', 'Product deleted successfully.');
            return redirect('product');
        } else {
            Session::flash('error', 'Sorry, something went wrong. Please try again.');
            return redirect('product');
        }
    }
    public function userProductDetail($id)
    {
        $product = ProductHelper::getByProductId($id);
        return view('product_detail',compact('product'));
    }
    public function cart()
    {
        return view('cart');
    }
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
          
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "pid" => $id,
                "name" => $product->product_name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->profileimage
            ];
        }
          
        session()->put('cart', $cart);
        Session::flash('success', 'Product added to cart successfully!');
        return redirect('cart');
    }
    public function updatecart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
