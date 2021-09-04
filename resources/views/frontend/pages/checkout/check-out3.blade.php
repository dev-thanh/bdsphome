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
                                            <a href="{{route('home.cart')}}" title="Giỏ hàng">
                                            Giỏ hàng
                                            </a>
                                        </li>
                                        <li>
                                            <a title="Thanh toán">
                                            Thanh toán
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
                                            <form action="" class="play__item">
                                                <div class="confirm__container">
                                                    <div class="confirm__item">
                                                        <h3 class="confirm__title">
                                                            Thông tin giao hàng
                                                        </h3>
                                                        <ul>
                                                            <li>
                                                                {{$order->name}}
                                                            </li>
                                                            <li>{{$order->email}}</li>
                                                            <li>{{$order->phone}}</li>
                                                        </ul>
                                                    </div>
                                                    <div class="confirm__item">
                                                        <h3 class="confirm__title">
                                                            Địa chỉ giao hàng
                                                        </h3>
                                                        <ul>
                                                            <li>
                                                                {{$order->address.', '.$order->getAddress($order->city_id,$order->district_id,$order->ward_id)}}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="info__payments">
                                                    <h3 class="payments__title">
                                                        Hình thức thanh toán
                                                    </h3>
                                                    @if($order->type ==1)
                                                    <p>
                                                        COD ( Thánh toán sau khi nhận hàng )
                                                    </p>
                                                    @elseif($order->type ==2)
                                                    <p>
                                                        Online ( Ví điện tử Momo )
                                                    </p>
                                                    @else
                                                    <p>
                                                        Online ( Thẻ Visa,Master Card )
                                                    </p>
                                                    @endif
                                                </div>
                                                <div class="info__payments">
                                                    <h3 class="payments__title">
                                                        Trạng thái đơn hàng
                                                    </h3>
                                                    @if($order->status ==1)
                                                    <p>
                                                        <span class="label label-primary">Chờ xác nhận</span>
                                                    </p>
                                                    @elseif($order->status == 0)
                                                    <p>
                                                        <span class="label label-primary">Thành công</span>
                                                    </p>
                                                    @else
                                                    <p>
                                                        <span class="label label-primary">Đã hủy</span>
                                                    </p>
                                                    @endif
                                                </div>
                                                <!-- <button type="submit" class="btn btn__next btn__add-cart" id="playments__next">
                                                Tiếp tục
                                                </button> -->
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
                                        <p class="single__code">
                                            Mã đơn hàng: {{$order->id}}
                                        </p>
                                        <table class="table">
                                            <tbody>
                                                @foreach($order_detail as $item)
                                                <tr>
                                                    <td>
                                                        <a href="" class="cart__product" title="{{$item->Products->name}}">
                                                            <div class="cart__product-avata">
                                                                <div class="frame">
                                                                    <img src="{{url('/').$item->Products->image}}" alt="{{$item->Products->name}}"/>
                                                                </div>
                                                            </div>
                                                            <div class="cart__product-content">
                                                                <h3 class="cart__product--title">
                                                                    {{$item->Products->name}}
                                                                </h3>
                                                                <p class="cart__size">
                                                                    {{$item->Products->volume}}
                                                                </p>
                                                                <p class="cart__total">
                                                                    Số lượng: {{$item->qty}}
                                                                </p>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td>
                                                    {{ number_format($item->Products->regular_price*$item->qty, 0, '.', '.') }}VND
                                                    </td>
                                                </tr>
                                                @endforeach
                                                
                                                <?php $poin_price = $order->getPoin($order->point); ?>
                                                <tr>
                                                    <td>
                                                        <p class="point">
                                                            Giảm giá
                                                        </p>
                                                        @if($order->point!=0)
                                                        <p class="point__info">
                                                            * Bạn đã sử dụng {{$order->point}} điểm thưởng cho hóa đơn
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
                                                        {{ number_format($order->total_price-$poin_price, 0, '.', '.') }}VND
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
                                                        {{ number_format($order->total_price-$poin_price, 0, '.', '.') }}VND
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