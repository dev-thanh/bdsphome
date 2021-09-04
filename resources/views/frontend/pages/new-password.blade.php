@extends('frontend.master')
@section('main')
    <main id="main">
        <section class="page__login">
            <div class="module moduel-page__login">
                <div class="container">
                    <div class="col-12 col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-9 text-center">

                        <h1 class="verification__title ">
                            Thay đổi mật khẩu
                        </h1>
                        <p class="text__forgot">
                            Vui lòng điền mật khẩu mới để xác nhận thay đổi
                            </p>

                    </div>
                    
                    <div class="col-12 col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-8 offset-sm-2">

                        <form class="from" method="POST" action="{{ route('home.new-password') }}">
                            @csrf
                            <input type="text" name="token" value="{{ $result->token }}" hidden="">
                            <input type="password" name="password" class="form-control input__account" value="{{old('password')}}" placeholder="Nhập mật khẩu mới"/>
                            @if($errors->has('password'))
                                <div class="error">{{ $errors->first('password') }}</div>
                            @endif
                            <input type="password" class="form-control input__account"  value="{!! old('confirm') !!}" name="confirm" placeholder="Nhập lại mật khẩu mới"/>
                            @if($errors->has('confirm'))
                                <div class="error">{{ $errors->first('confirm') }}</div>
                            @endif
                            @if($errors->has('pass_confirm'))
                                <div class="error">{{ $errors->first('pass_confirm') }}</div>
                            @endif
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <button type="submit" class="btn btn__secondary">Gửi
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection