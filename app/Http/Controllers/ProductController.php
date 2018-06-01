<?php

namespace App\Http\Controllers;


use App\Models\Product as Product;
use Illuminate\Http\Request;
use App\Http\helpers\ShopingCartHelper;
use App\Http\helpers\FeedBackHelper;

use Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->feedback = new FeedBackHelper();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products/index', ['products' => Product::all()]);
    }

    /**
     * Showing the result when searching products under a categorie
     * 
     * @param  string  $categorieName
     * @return \Illuminate\Http\Response
     */
    public function search($category) 
    {
        return view('products/search-products', ['products' => Product::with('categories')->whereHas('categories', 
            function($q) use($category) {
                $q->where('name', $category);
            })->get(), 'categorie' => $category]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function show(string $name)
    {
        return view('products/product', ['product' => Product::where('name', $name)->first() ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
     * get the contents of the shoping cart
     *
     * @param  \Illuminate\Http\Request  $reques
     */
    public function getCart()
    {
        $cart = new ShopingCartHelper();
        echo json_encode($cart->getCart());
    }

    /**
     * add items to the shoping cart
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function cartAdd(Request $request)
    {
        $cart = new ShopingCartHelper();
        echo json_encode($cart->addToCart($request));
    }

    /**
     * add items to the shoping cart
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function deleteFromCart(Request $request) 
    {
        $cart = new ShopingCartHelper();
        echo json_encode($cart->deleteFromCart($request));
    }

    public function editFromCart(Request $request)
    {
        $cart = new ShopingCartHelper();
        echo json_encode($cart->editFromCart($request));
    }
}
