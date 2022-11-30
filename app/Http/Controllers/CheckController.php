<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Requests\Checkout\StoreCheckoutRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Bank;
use App\Models\Cart;
use App\Models\Payment;
use Carbon\Carbon;
use App\Classes\PaystarPayment;

class CheckController extends Controller
{

    /**
     * 
     * Initializing the instances and variables
     *
     */
    public function __construct(protected PaystarPayment $startpayment)
    {

    }
  
    public function index()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->get(); 
        return view('admin.checkout.index', compact('carts'));
    }

    public function store(StoreCheckoutRequest $request)
    {
		$payment = $this->startpayment->create_payment($request);

		$sign = $this->startpayment->create_sign("store",$payment, $request=null);

		$data = $this->startpayment->data("store",$payment, $sign);

		$header = $this->startpayment->header();

		return $this->startpayment->send_to_shaparak($data, $header, $payment);

    }

    public function callback(Request $request)
    {
      if(isset($request->status))
      {

        if($request->status != 1) {
          return redirect(route('admin.checkout.index')."?status=error-r");
        } 

        if($request->status = 1) {

          	$payment = Payment::find($request->order_id);

			if($payment)
			{

				$newstring = substr($request->card_number, -4);

				if(str_contains($payment->first_cart, $newstring))
				{

					$this->startpayment->update("callback", $payment, $request);
					
					$sign = $this->startpayment->create_sign("callback",$payment, $request);

					$data = $this->startpayment->data("callback",$payment, $sign);

					$header = $this->startpayment->header();

					$result = Http::withHeaders($header)->post("https://core.paystar.ir/api/pardakht/verify", $data);

					$result = json_decode( $result->body());

					if(isset($result->data->price))
					{
						$payment->update([
							'is_pay' => 1,
						]);

						return redirect(route('admin.checkout.index')."?status=sucess");

					}

				}else {

					$this->startpayment->update("errorcard", $payment, $request);

				}

				return redirect(route('admin.checkout.index')."?status=error-card");
			}
        } 

      }

    }

	public function history()
	{
		$payments = Payment::where('user_id', auth()->id())->orderByDesc('id')->paginate(15)->appends(request()->except('page'));
		return view('admin.checkout.history', compact('payments'));
	}



}
