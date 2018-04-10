<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products/index', ['products' => Product::getAllProducts()]);
    }

    /**
     * Showing the result when searching products under a categorie
     * 
     * @param  string  $categorieName
     * @return \Illuminate\Http\Response
     */
    public function search($category) 
    {
        return view('products/search-products', ['products' => Product::getProductsFromTags($category), 'categorie' => $category]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function show(string $name)
    {
        return view('products/product', ['product' => Product::getProductByName($name)]);
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
    public function cartContents()
    {

        echo json_encode(array('succes'));
    }

    /**
     * add items to the shoping cart
     *
     * @param  \Illuminate\Http\Request  $reques
     */
    public function cartAdd(Request $request)
    {
        //Product::getProductById()
        //$id = $request->input('id');
        //$amount = $request->input('amount');
        
        //$validator = Validator::make($request->all(), [
        //    'id' => 'required|numeric|unique:products,id',
        //    'amount' => 'required|numeric',
        //]);


        //echo json_encode(array($validator));
    }
}
