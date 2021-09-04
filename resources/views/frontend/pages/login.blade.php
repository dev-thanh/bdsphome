@extends('frontend.master')
@section('main')
<main id="main">
    <section class="page__login">
        <div class="module moduel-page__login">
            <div class="container">
                <div class="col-12 col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                    <h1 class="verification__title text-center">
                        Đăng nhập với email
                    </h1>
                    <form action="{{route('home.post-login')}}" class="from" method="POST">
                        @csrf
                        <input name="email" type="text" class="form-control input__account" value="{{old('email')}}" placeholder="Tên đăng nhập hoặc email"/>
                        @if($errors->has('email'))
                            <div class="error">{{ $errors->first('email') }}</div>
                        @endif
                        <input name="password" type="password" class="form-control input__account" placeholder="Mật khẩu"/>
                        @if($errors->has('password'))
                            <div class="error">{{ $errors->first('password') }}</div>
                        @endif
                        @if($errors->has('confirmed'))
                            <div class="error">{{ $errors->first('confirmed') }}</div>
                        @endif
                        @if($errors->has('login_error'))
                            <div class="error">{{ $errors->first('login_error') }}</div>
                        @endif
                        <input type="hidden" name="tab" value="{{request()->tab}}">
                        <button type="submit" class="btn btn__secondary">Đăng nhập
                        </button>
                    </form>
                    <div class="link__between">
                        <a href="{{route('home.quen-mat-khau')}}" class="link__between-item">Quên mật khẩu ?</a>
                        <a href="{{route('home.register')}}" class="link__between-item">Tạo tài khoản</a>
                    </div>
                    <div class="group__login">
                        <p>Hoặc đăng nhập với
                        </p>
                        <div class="login__list">
                            <a href="{{url('/')}}/auth/redirect/facebook" class="btn ">
                            <img src="{{ __BASE_URL__ }}/images/icons/facebook_logo.svg" alt="">
                            Facebook
                            </a>
                            <a href="{{url('/')}}/auth/redirect/google" class="btn ">
                            <img src="{{ __BASE_URL__ }}/images/icons/google-icon.svg" alt="">
                            Google
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection