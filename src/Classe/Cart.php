<?php

namespace App\Classe;

use Symfony\Component\HttpFoundation\RequestStack;

class Cart
{
    public function __construct(private RequestStack $requestStack)
    {
        
    }

    /*
    * add()
    * fonction permettant l'ajout d'un produit au panier
    */

    public function add($product)
    {

        $cart=$this->getCart();
        if (isset($cart[$product->getId()])) {
            $cart[$product->getId()] = [
                'object' => $product,
                'qty' => $cart[$product->getId()]['qty'] + 1
            ];

        
    } else {
        $cart[$product->getId()] = [
            'object'=>$product,
            'qty'=>1
        ];
    }
        $this->requestStack->getSession()->set('cart', $cart);

    }

    /*
    * function()
    * fonction permettant la suppression d'un article du panier
    */

    public function decrease($id)
    {

        $cart=$this->getCart();
        if ($cart[$id]['qty'] >1){
            $cart[$id]['qty'] =$cart[$id]['qty']-1;
        }

    else {
        unset($cart[$id]);
    }


    $this->requestStack->getSession()->set('cart', $cart);

}

    /*
    * fullQuantity()
    * fonction permettant d'afficher la quantité totale de produits dans le panier
    */

    public function fullQuantity()
    {
        $cart=$this->getCart();
        $quantity=0;

        if(!isset($cart)){
            return $quantity;
        }

        foreach ($cart as $product){
            $quantity = $quantity+$product['qty'];
        }
        return $quantity;
    }

    /*
    * getTotalWt()
    * fonction permettant d'afficher le prix total TTC du panier
    */

    public function getTotalWt()
    {   $cart=$this->getCart();
        $price=0;

        if(!isset($cart)){
            return $price;
        }
 
        foreach ($cart as $product){
            $price = $price+($product['object']->getPriceWt()*$product['qty']);
        }
        return $price;
    }

    /*
    * remove()
    * fonction permettant de vider le panier
    */

    public function remove()
    {

        return $this->requestStack->getSession()->remove('cart');
    }

    /*
    * getCart()
    * fonction retournant le panier
    */

    public function getCart()
    {
        return $this->requestStack->getSession()->get('cart');
    }
}