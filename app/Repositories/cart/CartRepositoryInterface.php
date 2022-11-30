<?php

namespace App\Repositories\cart;

interface CartRepositoryInterface 
{
    public function get_all();

    public function createCart($request);

    public function updateCart($request, $cart);

    public function deleteCart($cart);


}