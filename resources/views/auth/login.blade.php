@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="container">
        <div class="row align-items-center justify-content-center no-gutters majid">
            <div class="card o-hidden border-0 shadow-lg my-5 col-5">
                <div class="card-body p-0">
                       <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">ورود به پنل</h1>
                            </div>
                            <form class="user" method="POST" action="{{route('login')}}">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-user"
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="نام کاربری">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="کلمه عبور">
                                </div>
                                {{-- <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember
                                            Me</label>
                                    </div>
                                </div> --}}
                                <button type="submit" class="btn btn-primary btn-user btn-block">ورود</button>
                            </form>
                            <hr>
                            {{-- <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div> --}}
                        </div>
                </div>
            </div>
        </div>
    </div>    

</form> 

@endsection
