@extends('frontend.master')
@section('main')
    <main id="main">
        <section class="page__login">
            <div class="module moduel-page__login">
                <div class="container">
                    <div class="container">
                        <div class="col-12 col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                            <h1 class="verification__title text-center">
                                Tạo tài khoản
                            </h1>
                            <form action="{{route('home.post-register')}}" class="from" method="POST">
                                @csrf
                                <input name="user_name" type="text" class="form-control input__account" placeholder="Tên đăng nhập" value="{{old('user_name')}}"/>
                                @if($errors->has('user_name'))
                                    <div class="error">{{ $errors->first('user_name') }}</div>
                                @endif
                                <input name="email" type="email" class="form-control input__account" placeholder="Email" value="{{old('email')}}"/>
                                @if($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                                <input name="phone" type="text" class="form-control input__account" placeholder="Số điện thoại" value="{{old('phone')}}"/>
                                @if($errors->has('phone'))
                                    <div class="error">{{ $errors->first('phone') }}</div>
                                @endif
                                <input name="password" type="password" class="form-control input__account" value="{{old('password')}}" placeholder="Mật khẩu"/>
                                @if($errors->has('password'))
                                    <div class="error">{{ $errors->first('password') }}</div>
                                @endif
                                <input name="password_confirmation" type="password" class="form-control input__account" value="{{old('password_confirmation')}}" placeholder="Xác nhận mật khẩu"/>
                                @if($errors->has('password_confirmation'))
                                    <div class="error">{{ $errors->first('password_confirmation') }}</div>
                                @endif
                                <p class="account__info">
                                    Bằng cách tiếp tục, bạn đồng ý với
                                    <a class="btn" href="page__rules.html">
                                        Điều khoản & Điều kiện
                                    </a>
                                    và tuyên bố về Quyền riêng tư của															                            chúng tôi .
                                </p>
                                <div class="accept">
                                    <input type="checkbox" name="accept" value="1" @if(old('accept')) checked @endif/>
                                    <span>Đồng ý với điều khoản dịch vụ</span>
                                    @if($errors->has('accept'))
                                        <div class="error">{{ $errors->first('accept') }}</div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn__secondary">
                                    Tạo tài khoản
                                </button>
                            </form>
                            <div class="link__between  login--right">
                                <a href="{{route('home.login')}}" class="link__between-item ">Đăng nhập</a>
                            </div>

                            <div class="group__login">
                                <p>Hoặc đăng nhập với
                                </p>
                                <div class="login__list">
                                    <button class="btn ">
                                        <img src="{{ __BASE_URL__ }}/images/icons/facebook_logo.svg" alt="">
                                        Facebook
                                    </button>
                                    <button class="btn ">
                                        <img src="{{ __BASE_URL__ }}/images/icons/google-icon.svg" alt="">
                                        Google
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</main>
@endsection