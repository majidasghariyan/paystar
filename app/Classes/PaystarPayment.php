<?php
namespace App\Classes;
use App\Models\Bank;
use App\Models\Cart;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PaystarPayment
{
    public function create_payment($request)
    {
        $payment = Payment::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'first_cart' => $request->shomare_cart,
            'pay_at' => Carbon::now(),
        ]); 

        return $payment;
    }

    public function create_sign($refrence, $payment, $request)
    {
        $secret = env('PAYSTAR_KEY');

        if($refrence == "store") 
        {
            $what =$payment->amount . "#" . $payment->id . "#http://127.0.0.1:8000/panel/checkout/callback/vertify";
        }elseif($refrence == "callback")
        {
            $what =$payment->amount . "#" . $payment->ref_num . "#" . $request->card_number . "#" . $request->tracking_code;
        }    
  
        $sign = hash_hmac('sha512', $what, $secret);

        return $sign;
    }

    public function data($refrence,$payment, $sign)
    {
        if($refrence == "store") 
        {
            $data = [
                'amount' => $payment->amount,
                'order_id' => $payment->id,
                "callback"=> "http://127.0.0.1:8000/panel/checkout/callback/vertify",
                "sign" => $sign
            ];
    
        } elseif($refrence == "callback") 
        {
            $data = [
                'amount' => $payment->amount,
                'ref_num' => $payment->ref_num,
                "sign" => $sign
              ];
        }

        return $data;
    }

    public function header()
    {
        $header = [
            'Authorization' => 'Bearer' . ' ' .env('PAYSTAR_GETWAY'),
            'Content-Type'=> 'application/json'
        ];

        return $header;
    }

    public function send_to_shaparak($data, $header, $payment)
    {
        try {
            $result = Http::withHeaders($header)->post("https://core.paystar.ir/api/pardakht/create", $data);
            // $result->json();
            // Log::info($result);
            // $return 1;
            $result = json_decode( $result->body());
    
            if($result->status)
            {
              $token = $result->data->token;
              $ref = $result->data->ref_num;
    
              if(Payment::where('ref_num', $ref)->exists()) {
                return redirect(route('admin.checkout.index')."?status=error-ref");
              } 
    
              $payment->update([
                'token' => $token,
                'ref_num' => $ref,
              ]);
    
              return Http::post("https://core.paystar.ir/api/pardakht/payment",['token' => $token]);
            }
    
          } catch (\Exception $e) {
    
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);
    
            $code = $e->getCode();       
            var_dump('Exception Code: '. $code);
    
            $string = $e->__toString();       
            var_dump('Exception String: '. $string);
    
            exit;
          }
    }


    public function update($refrence, $payment, $request)
    {
        if($refrence == "callback") 
        {
            $payment->update([
                'transaction_id' => $request->transaction_id,
                'last_cart' => $request->card_number,
                'tracking_code' => $request->tracking_code,
                'pay_at' => Carbon::now(),
            ]);
    
        } elseif($refrence == "errorcard") 
        {
            $payment->update([
                'status' => 2,
                'ref_num' => $request->ref_num,
                'transaction_id' => $request->transaction_id,
                'last_cart' => $request->card_number,
                'pay_at' => Carbon::now(),
            ]);
        }

    }
  
}