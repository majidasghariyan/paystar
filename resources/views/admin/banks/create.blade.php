@extends('layouts.admin')

@section('content')

	@include('partials.header',[
		'title' => 'افزودن بانک',
		'label' => 'افزودن بانک',

	])

    <hr>

    <form method="POST" action="{{route('admin.bank.store')}}">
        @csrf
        <div class="form-group row align-items-center justify-content-center">
          <label for="staticEmail" class="col-sm-2 col-form-label">نام</label>
          <div class="col-sm-8">
            <input type="text" name="name" class="form-control" placeholder="نام بانک " autocomplete="off">
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