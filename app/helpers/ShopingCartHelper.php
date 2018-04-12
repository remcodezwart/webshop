<?php

namespace App\helpers;

use Validator;
use App\Models\Product;


class ShopingCartHelper
{
    CONST CART = "Cart";

    private $product;
    private $input;
    private $session;

    private $increaseOrDecrease;

    public function __construct()
    {
    	$this->session = (!empty(session(self::CART))) ? session(self::CART) : array();
    }

    public function addToCart($request)
    {
    	$this->increaseOrDecrease = 'add';

    	$this->validate($request);

        $this->product = Product::getProductById($this->input['id']);

        if (!$this->product) {
        	$this->echoJson(array('succes' => false));
        } 

        if (empty($this->session) || array_filter($this->session, array($this, 'modifyAmount')) === []) {
        	$this->session[] = (object)['id' => $this->input['id'], 'amount' => $this->input['amount']];
        }
        
        $this->modifySession();
        $this->echoJson(array('succes' => true));
    }

    public function getCart()
    {
    	return $this->echoJson($this->session);
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

    private function modifyAmount($value)
    {
        if ($value->id == $this->product[0]->id) {
    		if ($this->increaseOrDecrease === 'add') {
    			$value->amount += $this->input['amount'];
    		} else if ($increaseOrDecrease === 'decrease') {
    			$value->amount -= $this->input['amount'];
    		}
    		return true;
    	} 
    }

    private function deleteFromSessionVariable($value)
    {
    	if ($value->id === $product[0]->id) {
    		unset($value);
    	}
    }

    private function echoJson(array $message)
    {
    	header('Content-Type: application/json');
		echo json_encode($message);
    }

}
