@extends('layouts.admin')

@section('content')

	@include('partials.header',[
		'title' => 'شارژ کیف پول',
		'label' => 'شارژ کیف پول',

	])

    <hr>
    @if(request("status") == "error-r")
        <div class="alert alert-danger">
            تراکنش ناموفق بود
        </div>
    @endif

    @if(request("status") == "error-card")
        <div class="alert alert-danger">
              شماره کارت پرداختی با شماره کارت انتخاب شده مطابقت ندارد. در صورت کسر وجه مبلغ به حساب شما باز می گردد.
        </div>
    @endif

    @if(request("status") == "error-ref")
        <div class="alert alert-danger">
            تراکنش به دلیل تکراری بودن کد پیگیری بانکی نامعتبر می باشد.
        </div>
    @endif


    @if(request("status") == "sucess")
        <div class="alert alert-success">
            پرداخت با موفقیت انجام شد.
        </div>
    @endif

    <form method="POST" action="{{route('admin.checkout.store')}}">
        @csrf

        @if($carts->isEmpty())
            <div class="alert alert-primary">
               لطفا کارت خود را ثبت کنید            
            </div>
        @else
            <div class="form-group row align-items-center justify-content-center">
                <label for="staticEmail" class="col-sm-2 col-form-label">شماره کارت</label>
                <div class="col-sm-8">
                    <select name="shomare_cart" class="form-control select_bank" id="bank">
                        <option></option>
                        @foreach($carts as $cart)
                            <option value="{{$cart->shomare_cart}}">{{$cart->shomare_cart}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif

        <div class="form-group row align-items-center justify-content-center">
            <label for="staticEmail" class="col-sm-2 col-form-label">مبلغ واریزی</label>
            <div class="col-sm-8">
                <input type="text" name="amount" class="form-control" placeholder="مبلغ واریزی" autocomplete="off">
            </div>
        </div>

        <div class="form-group row align-items-center justify-content-center">
            <div class="col-sm-10">
                <button type="submit" name="btn" class="btn btn-primary">
                    <i class="fa fa-check mr-1"></i>انتقال به درگاه پرداخت  
                </button>
            </div>
        </div>
    </form>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#bank').select2({
                dir: "rtl",
                placeholder: "شماره کارت مورد نظر را انتخاب کنید",
                allowClear: true
            });
        });
    </script>

@endsection