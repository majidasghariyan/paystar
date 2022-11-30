<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Requests\Cart\StoreCartRequest;
use App\Repositories\cart\CartRepositoryInterface;
use App\Models\Cart;
use App\Models\Bank;

class CartController extends Controller
{
    /**
     * Variable to hold injected dependency
     */

    private $repository;

    /**
     * 
     * Initializing the instances and variables
     *
     */
  
    public function __construct(CartRepositoryInterface $cartRepository){
      $this->repository = $cartRepository;
    }

    public function index()
    { 
        $carts = $this->repository->get_all();
        return view('admin.carts.index', compact('carts'));
    }

    public function create()
    {
      $banks = Bank::all();
      return view('admin.carts.create', compact('banks'));
    }

    public function store(StoreCartRequest $request)
    {
      $this->repository->createCart($request);
      alert_message('با موفقیت ثبت شد','success');
      return redirect()->back();
    }

    public function edit(Cart $cart)
    {
      $banks = Bank::all();
      return view('admin.carts.edit', compact('cart', 'banks'));
    }

    public function update(StoreCartRequest $request,Cart $cart)
    {
      $this->repository->updateCart($request, $cart);
      alert_message('با موفقیت ویرایش شد','success');
      return redirect()->back();
    }

    public function delete(Cart $cart)
    {
      $this->repository->deleteCart($cart);
      alert_message('با موفقیت حذف شد','success');
      return back();
    }
}
