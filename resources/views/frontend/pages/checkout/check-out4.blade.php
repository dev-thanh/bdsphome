<?php $session = Session::get('customer_account'); ?>
@extends('frontend.master')
@section('main')
    <main id="main">
        <div class="page__play">
            <div class="module module-pge__play">
                <div class="module__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-7">
                                <div class="info__auther">
                                    <h1 class="logo__play">
                                        <a href="{{route('home.index')}}">
                                        <img src="{{url('/').$site_info->logo}}" alt="Logo"/>
                                        </a>
                                    </h1>
                                    <ul class="breadcrumb__global">
                                        <li>
                                            <a href="{{route('home.index')}}" title="trang chủ">
                                            Trang chủ
                                            </a>
                                        </li>
                                        <li>
                                            <a title="Thanh toán">
                                                Thanh toán
                                            </a>
                                        </li>
                                        <li>
                                            <a title="Xác nhận">
                                                Xác nhận
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="play__content">
                                        <div class="play__control">
                                            <ul class="play__list active--100">
                                                <li class="play__list-item active--check">
                                                    Thông tin người nhận
                                                </li>
                                                <li class="play__list-item active--check">
                                                    Hình thức thanh toán
                                                </li>
                                                <li class="play__list-item active">
                                                    Xác nhận
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="play__main">
                                            <form action="{{route('home.post-check-out3')}}" class="play__item" method="POST">
                                                @csrf
                                                <div class="confirm__container">
                                                    <div class="confirm__item">
                                                        <h3 class="confirm__title">
                                                            Thông tin giao hàng
                                                        </h3>
                                                        <ul>
                                                            <li>
                                                                {{isset($session['name']) ? $session['name'] : null}}
                                                            </li>
                                                            <li>{{isset($session['email']) ? $session['email'] : null}}</li>
                                                            <li>{{isset($session['phone']) ? $session['phone'] : null}}</li>
                                                        </ul>
                                                        <a href="{{route('home.check-out1')}}" class="btn btn__edit">
                                                        Chỉnh sửa
                                                        </a>
                                                    </div>
                                                    <div class="confirm__item">
                                                        <h3 class="confirm__title">
                                                            Địa chỉ giao hàng
                                                        </h3>
                                                        <ul>
                                                            <li>
                                                                {{$session['address'].', '.App\Models\Order::getAddress($session['city'],$session['district'],$session['ward'])}}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="info__payments">
                                                    <h3 class="payments__title">
                                                        Hình thức thanh toán
                                                    </h3>
                                                    <p>
                                                        @if($session['payments'] == 1)
                                                            COD ( Thánh toán sau khi nhận hàng )
                                                        @elseif($session['payments'] == 2)
                                                            Online ( Ví điện tử Momo )
                                                        @else
                                                            Online ( Thẻ Visa,Master Card )
                                                        @endif
                                                    </p>
                                                    <a href="#" class="btn btn__edit">
                                                    Thay đổi hình thức thanh toán
                                                    </a>
                                                    <p>
                                                        Bằng cách tiếp tục, bạn đồng ý với
                                                        <a class="btn btn__edit" href="#">
                                                        Điều khoản & Điều kiện
                                                        </a>
                                                        và tuyên
                                                        bố về Quyền riêng tư của chúng tôi .
                                                    </p>
                                                </div>
                                                <button type="submit" class="btn btn__next btn__add-cart" id="playments__next">
                                                Tiếp tục
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-5 bgc__after">
                                <div class="info__cart">
                                    <div class="single__row">
                                        <h3 class="single__title">
                                            Thông tin đơn hàng
                                        </h3>
                                        <!-- <p class="single__code">
                                            Mã đơn hàng: 1234
                                        </p> -->
                                        <table class="table">
                                            <tbody>
                                                @foreach(Cart::content() as $item)
                                                <tr>
                                                    <td>
                                                        <a href="" class="cart__product" title="{{$item->options->name}}">
                                                            <div class="cart__product-avata">
                                                                <div class="frame">
                                                                    <img src="{{url('/').$item->options->image}}" alt="{{$item->options->name}}"/>
                                                                </div>
                                                            </div>
                                                            <div class="cart__product-content">
                                                                <h3 class="cart__product--title">
                                                                    {{$item->options->name}}
                                                                </h3>
                                                                <p class="cart__size">
                                                                    {{$item->options->volume}}
                                                                </p>
                                                                <p class="cart__total">
                                                                    Số lượng: {{$item->qty}}
                                                                </p>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td>
                                                    {{ number_format($item->price*$item->qty, 0, '.', '.') }}VND
                                                    </td>
                                                </tr>
                                                @endforeach
                                                
                                                <?php $poin_price = isset($session['point']) ? App\Models\Order::getPoin($session['point']) : 0; ?>
                                                <tr>
                                                    <td>
                                                        <p class="point">
                                                            Giảm giá
                                                        </p>
                                                        @if(isset($session['point']))
                                                        <p class="point__info">
                                                            * Bạn đã sử dụng {{$session['point']}} điểm thưởng cho hóa đơn
                                                        </p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                    {{ number_format($poin_price, 0, '.', '.') }}VND
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Tạm tính
                                                    </td>
                                                    <td>
                                                        {{ number_format(Cart::total()-$poin_price, 0, '.', '.') }}VND
                                                    </td>
                                                </tr>
                                                <!-- <tr>
                                                    <td>
                                                        Phí vận chuyển
                                                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                    </td>
                                                    <td>
                                                        30.000
                                                    </td>
                                                </tr> -->
                                                <tr>
                                                    <td>
                                                        <b>
                                                        Tổng tiền
                                                        </b>
                                                    </td>
                                                    <td>
                                                        <b>
                                                        {{ number_format(Cart::total()-$poin_price, 0, '.', '.') }}VND
                                                        </b>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection