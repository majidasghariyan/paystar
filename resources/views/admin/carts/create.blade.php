@extends('layouts.admin')

@section('content')

	@include('partials.header',[
		'title' => 'افزودن بانک',
		'label' => 'افزودن بانک',

	])

    <hr>

    <form method="POST" action="{{route('admin.cart.store')}}">
        @csrf

        <div class="form-group row align-items-center justify-content-center">
			<label for="staticEmail" class="col-sm-2 col-form-label">بانک</label>
			<div class="col-sm-8">
				<select name="bank_id" class="form-control select_bank" id="bank">
					<option></option>
					@foreach($banks as $bank)
						<option value="{{$bank->id}}">{{$bank->name}}</option>
					@endforeach
				</select>
			</div>
        </div>


        <div class="form-group row align-items-center justify-content-center">
          <label for="staticEmail" class="col-sm-2 col-form-label">شماره کارت</label>
          <div class="col-sm-8">
            <input type="text" name="shomare_cart" class="form-control" placeholder="شماره کارت" autocomplete="off">
          </div>
        </div>

        <div class="form-group row align-items-center justify-content-center">
          <label for="staticEmail" class="col-sm-2 col-form-label">شماره شبا</label>
          <div class="col-sm-8">
            <input type="text" name="shomare_shaba" class="form-control" placeholder="شماره شبا" autocomplete="off">
          </div>
        </div>

        <div class="form-group row align-items-center justify-content-center">
            <div class="col-sm-10">
                <button type="submit" name="btn" class="btn btn-primary">
                    <i class="fa fa-check mr-1"></i>ذخیره
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
                placeholder: "بانک مورد نظر را انتخاب کنید",
                allowClear: true
            });
        });
    </script>

@endsection