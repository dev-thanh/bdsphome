@extends('frontend.master')
@section('main')
<?php $auth = auth('customer')->user(); ?>
<main id="main">
        <div class="page__play">
            <div class="module module-pge__play">
                <div class="module__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-7">
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
                                            <a title="Thông tin người nhận">
                                                Thông tin người nhận
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="play__content">
                                        <div class="play__control">
                                            <ul class="play__list">
                                                <li class="play__list-item active">
                                                    Thông tin người nhận
                                                </li>
                                                <li class="play__list-item">
                                                    Hình thức thanh toán
                                                </li>
                                                <li class="play__list-item">
                                                    Xác nhận
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="play__main">
                                            <form id="form_add_cart" action="{{route('home.post-check-out1')}}" class="play__item" method="POST">
                                                @csrf
                                                <div class="play__group">
                                                    <h3>Liên hệ</h3>
                                                    @if(!Auth::guard('customer')->check())
                                                    <a href="{{route('home.login')}}?tab=checkout" class="btn btn__delete">
                                                    Tôi có tài khoản
                                                    </a>
                                                    @endif
                                                </div>
                                                <div class="play__form">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <input type="email" name="email" placeholder="Email" class="form-control play__input" value="{{$auth ? $auth->email : ''}}"/>
                                                                <span class="fr-error" id="error_email"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <input type="text" name="name" placeholder="Họ tên" class="form-control play__input" value="{{$auth ? $auth->name : ''}}"/>
                                                                <span class="fr-error" id="error_name"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <input type="number" name="phone" placeholder="Số điện thoại" class="form-control play__input" value="{{$auth ? $auth->phone : ''}}"/>
                                                                <span class="fr-error" id="error_phone"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="play__group">
                                                    <h3>Địa chỉ giao hàng</h3>
                                                </div>
                                                <div class="play__form">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <select class="form-control play__input control__select2" name="city">
                                                                    <option value="" hidden>Tỉnh / TP</option>
                                                                    </option>
                                                                    @foreach($city as $item)
                                                                    <option value="{{$item->id}}" data-name="{{$item->city_name}}">
                                                                        {{$item->city_name}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                <span class="fr-error" id="error_city"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <select class="form-control play__input control__select2" name="district">
                                                                    <option value="">
                                                                        Quận Huyện
                                                                    </option>
                                                                </select>
                                                                <span class="fr-error" id="error_district"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <select class="form-control play__input control__select2" name="ward">
                                                                    <option value="">
                                                                        Xã / Phường
                                                                    </option>
                                                                </select>
                                                                <span class="fr-error" id="error_ward"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control play__input" name="address" placeholder="Địa  chỉ cụ thể"/>
                                                                <span class="fr-error" id="error_address"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn__next btn__add-cart">
                                                    Tiếp tục thanh toán
                                                </button>
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
                                                                <input type="number" class="from-control" name="point" placeholder="Điểm thưởng">
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
                                                <button class="btn btn__next btn__continute">Tiếp tục mua hàng</button>
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
            $('select[name="city"]').on('change', function() {

                var id_city = $(this).val();
                console.log(id_city);

                $.ajax({
                    url: base_url+'/quan-huyen/'+id_city,
                    type:'GET',
                    success: function(data) {

                        $('select[name="district"]').html(data);
                   
                    }
                });
            });

            $('select[name="district"]').on('change', function() {

                var id_district = $(this).val();
                $.ajax({
                    url: base_url+'/xa-phuong/'+id_district,
                    type:'GET',
                    success: function(data) {

                        $('select[name="ward"]').html(data);
                
                    }
                });
            });

            $('.btn__add-cart').on('click',function(e){
                e.preventDefault();

                var UrlContact =$('#form_add_cart').attr('action');

                var data = $("#form_add_cart").serialize();

                $.ajax({

                    type: 'POST',

                    url: UrlContact,

                    dataType: "json",

                    data: data,

                    success:function(data){

                        if(data.check_login==0){
                            toastr["error"](data.message, "Thông báo");
                        }
                        if(data.check_cart==0){
                            toastr["error"](data.message, "Thông báo");
                        }

                        if(data.status==1){
                            window.location.href=data.url;
                        }

                        if(data.email){

                            $('.fr-error').css('display', 'block');

                            $('#error_email').html(data.email);

                        } else {

                            $('#error_email').html('');

                        }

                        if(data.name){

                            $('.fr-error').css('display', 'block');

                            $('#error_name').html(data.name);

                        } else {

                            $('#error_name').html('');

                        }
                        if(data.phone){

                            $('.fr-error').css('display', 'block');

                            $('#error_phone').html(data.phone);

                        } else {

                            $('#error_phone').html('');

                        }
                        if(data.city){

                            $('.fr-error').css('display', 'block');

                            $('#error_city').html(data.city);

                        } else {

                            $('#error_city').html('');

                        }
                        if(data.district){

                            $('.fr-error').css('display', 'block');

                            $('#error_district').html(data.district);

                        } else {

                            $('#error_district').html('');

                        }
                        if(data.ward){

                            $('.fr-error').css('display', 'block');

                            $('#error_ward').html(data.ward);

                        } else {

                            $('#error_ward').html('');

                        }

                        if(data.address){

                            $('.fr-error').css('display', 'block');

                            $('#error_address').html(data.address);

                        } else {

                            $('#error_address').html('');

                        }
                    }

                });
            });

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
                        if(data.login_false==0){
                            toastr["error"](data.message, "Thông báo");
                        }
                
                    }
                });
            });
        </script>
    @endsection
@endsection