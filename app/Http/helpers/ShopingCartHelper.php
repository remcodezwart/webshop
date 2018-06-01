<?php

namespace App\Http\helpers;

use Validator;
use App\Models\Product as Product;


class ShopingCartHelper
{
    CONST CART = "Cart";

    private $product;
    private $input;
    private $session;

    public function __construct()
    {
    	$this->session = (!empty(session(self::CART))) ? session(self::CART) : array();
    }

    public function getCart()
    {
    	return $this->echoJson($this->getCartContens());
    }

    public function getCartContens()
    {
        return Product::find(array_column($this->session, 'id'));
    }

    public function deleteAllFromCart()
    {
        session([self::CART => '']);
    }

    public function addToCart($request)
    {
        $this->validate($request);

        $this->product = Product::find($this->input['id']);

        if (!$this->product || $this->isAmountLargerThanStock()) {
            return $this->echoJson(array('succes' => false, 'message' => 'Er is een onbekende fout opgetreden'));
        } 

        if (empty($this->session) || array_filter($this->session, array($this, 'modifyAmount')) === []) {
            $this->session[] = (object)['id' => $this->input['id'], 'amount' => $this->input['amount']];
        }
        
        $this->modifySession();
        return $this->echoJson(array('succes' => true, 'message' => 'Product succesvol toegevoegd'));
    }

    public function editFromCart($request)
    {
        $this->validateForEdit($request);

        $this->product = Product::where('name', $this->input['name'])->first();

        if (!$this->product || $this->isAmountLargerThanStock()) {
            return $this->echoJson(array('succes' => false, 'message' => 'Er is een onbekende fout opgetreden'));
        }

        if ($this->input['amount'] == 0) {
            array_filter($this->session, array($this, 'deleteFromSessionVariable'));
        } else {
            array_filter($this->session, array($this, 'modifyAmount'));
        }

        $this->modifySession();
        return $this->echoJson(array('succes' => true, 'message' => 'Product succesvol bewerkt'));
    }

    public function deleteFromCart($request)
    {
        $this->validateForDelete($request);

        $this->product = Product::where('name', $this->input['name'])->first();

        if (!$this->product) {
            return $this->echoJson(array('succes' => false, 'message' => 'Er is een onbekende fout opgetreden'));
        }

        $this->session = array_filter($this->session, array($this, 'deleteFromSessionVariable'));

        $this->modifySession();
        return $this->echoJson(array('succes' => true, 'message' => 'Product succesvol verwijderd'));
    }

    private function validateForEdit($request)
    {
        $this->input = $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric|integer|min:0'
        ]);
    }

    private function modifyAmount($value)
    {
        if ($value->id == $this->product->id) {
            $value->amount = $this->input['amount'];
            return true;
        } 
        return false;
    }

    private function deleteFromSessionVariable($value)
    {
    	if ($value->id != $this->product->id) {
            return true;
    	}
        return false;
    }

    private function isAmountLargerThanStock()
    {
        if ($this->product->amount >= $this->input['amount']) return false;
        return true;
    }

    private function modifySession()
    {
        session([self::CART => $this->session]);
    }

    private function validate($request)
    {
        $this->input = $request->validate([
            'id' => 'required|numeric|integer|min:1',
            'amount' => 'required|numeric|integer|min:1',
        ]);
    }

    private function validateForDelete($request)
    {
        $this->input = $request->validate(['name' => 'required']);
    }

    private function echoJson($message)
    {
    	header('Content-Type: application/json');
        return $message;
    }

}