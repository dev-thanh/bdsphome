@extends('frontend.master')
@section('main')
    <main id="main">
        <div class="container">
            <ul class="breadcrumb__global">
                <li>
                    <a href="{{route('home.index')}}" title="trang chủ">
                    Trang chủ
                    </a>
                </li>
                <li>
                    <a href="{{route('home.profile')}}" title="Tài khoản">
                    Tài khoản
                    </a>
                </li>
            </ul>
        </div>
        <section class="page__account">
            <div class="container">
                <div class="module module-page__account">
                    <div class="module__content">
                        <div class="bs-tab">
                            <div class="tab-container">
                                <div class="tab-control">
                                    <h3 class="auther__title edit__user">
                                        Tài khoản của tôi
                                    </h3>
                                    <ul class="control-list">
                                        <li class="control-list__item active">
                                            <a class="btn btn__view-cart" href="{{route('home.profile')}}">
                                            Thông tin tài khoản
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-item active" id="tab1">
                                        <div class="account__container">
                                            <h3 class="account__title">
                                                Thay đổi thông tin cá nhân
                                            </h3>
                                            <form action="{{route('home.post-edit-account')}}" class="edit__account" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <label for="">
                                                        Họ tên *
                                                        </label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="name" value="{{ old('name',$customer->name) }}">
                                                            @if($errors->has('name'))
                                                                <div class="error">{{ $errors->first('name') }}</div>
                                                            @endif
                                                        </div>
                                                        <label for="">
                                                        Số điện thoại *
                                                        </label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="phone" value="{{ old('phone',$customer->phone) }}">
                                                            @if($errors->has('phone'))
                                                                <div class="error">{{ $errors->first('phone') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <label for="">
                                                        Email *
                                                        </label>
                                                        <div class="form-group">
                                                            <input type="email" class="form-control" name="email" value="{{ old('email',$customer->email) }}">
                                                            @if($errors->has('email'))
                                                                <div class="error">{{ $errors->first('email') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3 class="edit__title">
                                                    Thay đổi mật khẩu
                                                </h3>
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <label for="">
                                                        Mật khẩu hiện tại *
                                                        </label>
                                                        <div class="form-group">
                                                            <input type="password" name="old_password" class="form-control" value="{{old('old_password',$customer->old_password)}}">
                                                            @if($errors->has('old_password'))
                                                                <div class="error">{{ $errors->first('old_password') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <label for="">
                                                        Mật khẩu mới *
                                                        </label>
                                                        <div class="form-group">
                                                            <input type="password" name="password" class="form-control" value="{{old('password')}}">
                                                            @if($errors->has('password'))
                                                                <div class="error">{{ $errors->first('password') }}</div>
                                                            @endif
                                                        </div>
                                                        <label for="">
                                                        Xác nhận mật khẩu mới*
                                                        </label>
                                                        <div class="form-group">
                                                            <input type="password" name="password_confirmation" class="form-control" value="{{old('password_confirmation',$customer->password_confirmation)}}">
                                                            @if($errors->has('password_confirmation'))
                                                                <div class="error">{{ $errors->first('password_confirmation') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button class="btn btn__cart-play">
                                                    Lưu thay đổi
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
@endsection