@extends('frontend.master')
@section('main')
    <main id="main">
        <section class="page__login">
            <div class="module moduel-page__login">
                <div class="container">
                    <div class="col-12 col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-9 text-center">

                        <h1 class="verification__title ">
                            Lấy lại mật khẩu
                        </h1>
                        <p class="text__forgot">
                            Nhập email mà bạn đã dùng để đăng ký tài khoản với Beheshop.<br/>
                            Chúng tôi sẽ gửi cho bạn một mật khẩu
                                                                                                                                                                                                                                                                                                                            mới.
                        </p>

                    </div>
                    <div class="col-12 col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-8 offset-sm-2">

                        <form class="from" method="POST" action="{{route('home.post-quen-mat-khau')}}">
                            @csrf
                            <input type="email" name="email" class="form-control input__account" value="{{old('email')}}" placeholder="Nhập email đăng ký tài khoản"/>
                            @if($errors->has('email'))
                                <div class="error">{{ $errors->first('email') }}</div>
                            @endif
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
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