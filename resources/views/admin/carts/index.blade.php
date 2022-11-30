@extends('layouts.admin')

@section('content')

    @include('partials.header',[
        'title' => 'لیست کارت ها',
        'label' => 'افزودن کارت',
        'route' => 'admin.cart.create',
    ])

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">نام بانک</th>
                    <th scope="col">شماره بانک</th>
                    <th scope="col">شماره شبا</th>
                    <th scope="col">عملیات</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($carts as $cart)
                        <tr>
                            <td>{{$cart->id}}</td>
                            <td>
                                @if(!empty($cart->bank_id))
                                    {{$cart->bank->name}}
                                @endif
                            </td>
                            <td>
                                {{$cart->shomare_cart}}
                            </td>
                            <td>
                                {{$cart->shomare_shaba}}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.cart.edit', $cart) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="" data-original-title="ویرایش">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>

                                <form style="display:inline-block;" method="post" action="{{ route('admin.cart.delete', $cart) }}" cart="form">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="" data-original-title="حذف">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-sm-12">
                @if($carts instanceof \Illuminate\Pagination\LengthAwarePaginator )
                    {{ $carts->onEachSide(1)->links('vendor.pagination.to_pagination', ['class' => 'd-flex justify-content-center align-items-center flex-wrap']) }}
                @endif

        </div>
    </div>

@endsection