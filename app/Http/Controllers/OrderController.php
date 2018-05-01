<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Client as Client;
use App\Models\Order_lines as OrderLine;
use App\Models\Orders as Order;
use App\Http\helpers\ShopingCartHelper;


class OrderController extends Controller
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
    * Show a list of orders.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        if (!Client::where('user_id', Auth::user()->id)->first()) {
            $orders = false;
        } else {
            $client = Client::where('user_id', Auth::user()->id)->first();
            $orders = Order::where('client_id', $client->id)->get();
        }

        return view('orders/index', ['orders' => $orders]);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function placeOrder()
    {
    	$cart = new ShopingCartHelper();

        if (!Client::where('user_id', Auth::user()->id)->first() && $cart->getCart() !== []) {
        	return redirect('orders/index');
        } else {
            $client = Client::where('user_id', Auth::user()->id)->first();
        }

        $items = $cart->getCartContens();
        $order = new Order;

        $order->client_id  = $client->id;	
        $order->status     = 'Besteld'; 	
        $order->date_order = date('Y-m-d G-i-s');

        $order->save();

        foreach ($items as $item) {
        	$orderLine             = new OrderLine;
        	$orderLine->order_id   = $order->id;
        	$orderLine->product_id = $item->id;
        	$orderLine->amount     = $item->ShopingAmount; 
        	$orderLine->price      = $item->price;
        	$orderLine->save();
        }

        $cart->deleteAllFromCart();

        return redirect('orders');
    }


}
