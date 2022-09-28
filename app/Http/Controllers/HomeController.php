<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ProductHelper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['productData'] = ProductHelper::getActiveProductData();
        return view('user_dashboard',$data);
    }
    public function admindashboard()
    {
        return view('home');
    }
}
