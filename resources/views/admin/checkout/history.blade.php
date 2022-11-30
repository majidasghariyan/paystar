@extends('layouts.admin')

@section('content')

    @include('partials.header',[
        'title' => 'تاریخچه پرداخت ها',
        'label' => 'تاریخچه پرداخت',
    ])

    @if($payments->isEmpty())

        <div class="alert alert-primary">
            پرداختی از طرف شما ثبت نشده است.                    
        </div>

    @else

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">مبلغ</th>
                        <th scope="col">وضعیت</th>
                        <th scope="col">شماره کارت</th>
                        <th scope="col">تاریخ پرداخت</th>
                        <th scope="col">کد رهگیری بانکی</th>
                        <th scope="col">شناسه تراکنش</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{$payment->id}}</td>

                                <td>
                                    {{number_format($payment->amount)}}
                                </td>
                                <td>
                                    @if($payment->is_pay == "1")
                                        <div class="badge badge-success">موفق</div>
                                    @else 
                                        <div class="badge badge-danger">نا موفق</div>
                                    @endif
                                </td>
                                <td dir="ltr">
                                    @if(!empty($payment->last_cart))
                                        {{$payment->last_cart}}
                                    @else 
                                        {{$payment->first_cart}}
                                    @endif
                                </td>
                                <td dir="ltr">
                                    @if(!empty($payment->pay_at))
                                        {{\Morilog\Jalali\Jalalian::forge($payment->pay_at)->format('Y/m/d h:s')}}
                                    @endif    
                                </td>
                                <td>
                                    @if(!empty($payment->tracking_code))
                                        {{$payment->tracking_code}}
                                    @else 
                                        --
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($payment->transaction_id))
                                        {{$payment->transaction_id}}
                                    @else 
                                        --
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-sm-12">
                    @if($payments instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        {{ $payments->onEachSide(1)->links('vendor.pagination.to_pagination', ['class' => 'd-flex justify-content-center align-items-center flex-wrap']) }}
                    @endif

            </div>
        </div>

    @endif

@endsection