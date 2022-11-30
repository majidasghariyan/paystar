@extends('layouts.admin')

@section('content')

    @include('partials.header',[
        'title' => 'لیست بانک ها',
        'label' => 'افزودن بانک',
        'route' => 'admin.bank.create',
    ])

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">نام</th>
                    <th scope="col">عملیات</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($banks as $bank)
                        <tr>
                            <td>{{$bank->id}}</td>
                            <td>{{$bank->name}}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.bank.edit', $bank) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="" data-original-title="ویرایش">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>

                                <form style="display:inline-block;" method="post" action="{{ route('admin.bank.delete', $bank) }}" bank="form">
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
                @if($banks instanceof \Illuminate\Pagination\LengthAwarePaginator )
                    {{ $banks->onEachSide(1)->links('vendor.pagination.to_pagination', ['class' => 'd-flex justify-content-center align-items-center flex-wrap']) }}
                @endif

        </div>
    </div>

@endsection