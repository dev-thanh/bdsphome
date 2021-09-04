@extends('frontend.master')
@section('main')
<?php $session = Session::get('customer_account'); ?>
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
                                            <a title="Hình thức thanh toán">
                                                Hình thức thanh toán
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="play__content">
                                        <div class="play__control">
                                            <ul class="play__list active--55">
                                                <li class="play__list-item active--check">
                                                    Thông tin người nhận
                                                </li>
                                                <li class="play__list-item active">
                                                    Hình thức thanh toán
                                                </li>
                                                <li class="play__list-item">
                                                    Xác nhận
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="play__main">
                                            <form action="{{route('home.post-check-out2')}}" class="play__item" method="POST">
                                                @csrf
                                                <div class="play__group">
                                                    <h3>Hình thức thanh toán</h3>
                                                </div>
                                                <label for="payments__1" class="payments">
                                                <input type="radio" id="payments__1" name="payments" checked="checked" value="1">
                                                <span class="payments__raido">
                                                COD ( Thanh toán sau khi nhận hàng )
                                                </span>
                                                </label>
                                                <label for="payments__2" class="payments">
                                                <input type="radio" id="payments__2" name="payments" value="2">
                                                <span class="payments__raido">
                                                Ví điện tử Momo
                                                </span>
                                                </label>
                                                <label for="payments__3" class="payments">
                                                <input type="radio" id="payments__3" name="payments" value="3">
                                                <span class="payments__raido">
                                                Thẻ Visa, Master card
                                                </span>
                                                </label>
                                                <div class="playments__control">
                                                    <a href="page__pay.html" class="btn btn__view-cart">
                                                    Thông tin thanh toán
                                                    </a>
                                                    <button type="submit" class="btn btn__next btn__add-cart" id="playments__next">
                                                    Tiếp tục
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(Cart::count())
                            <div class="col-12 col-sm-5 bgc__after">
                                <div class="info__cart">
                                    <div class="single__row">
                                        <h3 class="single__title">
                                            Thông tin đơn hàng
                                        </h3>
                                        <div class="table__res">
                                            <table class="table">
                                                <tbody>
                                                    @foreach(Cart::content() as $item)
                                                    <tr>
                                                        <td>
                                                            <a href="{{route('home.single.product',['slug'=>$item->options->slug])}}" title="{{$item->name}}" class="cart__product" title="cart__product-avata">
                                                                <div class="cart__product-avata">
                                                                    <div class="frame">
                                                                        <img src="{{url('/').@$item->options->image}}" alt="{{$item->name}}"/>
                                                                    </div>
                                                                </div>
                                                                <div class="cart__product-content">
                                                                    <h3 class="cart__product--title">
                                                                        {{$item->name}}
                                                                    </h3>
                                                                    <p class="cart__size">
                                                                        {{@$item->options->volume}}
                                                                    </p>
                                                                    <p class="cart__total">
                                                                        Số lượng: {{$item->qty}}
                                                                    </p>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>
                                                        {{ number_format($item->price, 0, '.', '.') }}VND
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="total__goup">
                                                                <input type="number" class="from-control" name="point" value="{{isset($session['point']) ? $session['point'] : '' }}" placeholder="Điểm thưởng">
                                                                <button class="btn btn__total btn__add__point">
                                                                Áp dụng
                                                                </button>
                                                            </div>
                                                            <p class="point">
                                                                * Điểm hiện tại của bạn: 100
                                                            </p>
                                                            <p class="point__info">
                                                                Mỗi điểm thưởng tương đương với 1000VND. Tích điểm bằng cách mua sắm, mua sắm càng nhiều điểm
                                                                thưởng càng nhiều
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Tạm tính
                                                        </td>
                                                        <td>
                                                            {{number_format(Cart::total(), 0, '.', '.')}}VND
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
                                                            {{number_format(Cart::total(), 0, '.', '.')}}VND
                                                            </b>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="col-12 col-sm-5 bgc__after" style="margin: auto">
                                <div class="info__cart">
                                    <div class="single__row">
                                        <h3 class="single__title" style="text-align:center">
                                            Không tìm thấy sản phẩm nào cần thanh toán
                                        </h3>
                                        <a href="{{route('home.index')}}">
                                            <button class="btn btn__next btn__add-cart">Tiếp tục mua hàng</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    @section('script')
    <script>
        var base_url = $('input[name="base_url"]').val();
        $('.btn__add__point').on('click',function(){

            var point = $('input[name="point"]').val();

            $.ajax({
                url: base_url+'/kiem-tra-diem',

                type:'GET',

                data: {point:point},

                success: function(data) {

                    if(data.status==0){
                        toastr["error"](data.message, "Thông báo");
                    }

                    if(data.status==1){
                        toastr["success"](data.message, "");
                    }
                    if (data.login_false==0) {
                        toastr["error"](data.message, "Thông báo");
                    }
                }
            });
        });
    </script>
    @endsection
@endsection