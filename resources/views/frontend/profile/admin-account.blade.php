@section('admin-css')
<link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/admins/admin-user.css" />
<link rel="stylesheet" type="text/css" href="{{ __BASE_URL__ }}/css/toastr.min.css" />
@stop
@extends('frontend.profile.general')
@section('main-admin')
    <main id="main">
        @include('frontend.profile.main-admin-header')
        <form action="{{route('admin.update-account')}}" method="POST" id="update__account__user">
            <div class="card personal__card">
                <h1 class="title__global">Thông tin cá nhân</h1>
                <div class="card__form">
                    <div class="personal__sex">
                        <label for="male" class="radio__cus">
                            <input type="radio" class="radio__input" name="sex" value="1" id="male" @if($auth->sex==1 || $auth->sex==null) checked @endif/>
                            <span class="radio__name"> Nam </span>
                        </label>
                        <label for="female" class="radio__cus">
                            <input type="radio" class="radio__input" name="sex" value="2" id="female"@if($auth->sex==2) checked @endif />
                            <span class="radio__name"> Nữ </span>
                        </label>
                        <label for="other" class="radio__cus">
                            <input type="radio" class="radio__input" name="sex" value="3" id="other" @if($auth->sex==3) checked @endif/>
                            <span class="radio__name"> Khác </span>
                        </label>
                    </div>
                    <div class="personal__enter">
                        <div class="personal__row">
                            <div class="personal__col">
                                <label for="" class="name__global"> Họ và tên *</label>
                                <input type="text" placeholder="Họ và tên ..." value="{{$auth->name}}" name="name" class="fr__name" />
                                <!-- <span class="fr-error fr-error_name">Họ tên không được để trống</span> -->
                            </div>
                            <div class="personal__col">
                                <label for="" class="name__global"> Ngày sinh</label>
                                <input type="text" placeholder="VD: 09/06/1995" value="{{$auth->birthday}}" name="birthday" class="fr__birthday"/>
                            </div>
                            <div class="personal__col">
                                <label for="" class="name__global"> Đối tượng </label>
                                <select class="personal__select fr__object" name="object">
                                    <option value="Nhà môi giới">Nhà môi giới</option>
                                    <option value="Chủ sở hữu">Chủ sở hữu</option>
                                </select>
                            </div>
                        </div>
                        <div class="personal__row">
                            <label for="" class="name__global"> Địa chỉ*</label>
                            <div class="presonal__grid">
                                <div class="personal__col">
                                    <div class="personal__item">
                                        <span class="name__dots">
                                            Tỉnh/Thành phố*
                                        </span>
                                        <select class="city__​​province" name="city_id">
                                            <option value="">Chọn Tỉnh/Thành phố</option>
                                            @foreach($city as $item)
                                            <option value="{{$item->id}}" @if($auth->city_id == $item->id) selected="selected" @endif>{{$item->city_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="fr-error" id="error_city"></span>
                                    </div>
                                </div>
                                <div class="personal__col">
                                    <div class="personal__item">
                                        <span class="name__dots"> Quận/Huyện* </span>
                                        <select class="district fr__district_id" name="district_id">
                                            @if($district != null)
                                                <option value="">Quận/Huyện</option>
                                                @foreach($district as $item)
                                                    <option value="{{$item->id}}" @if($auth->district_id == $item->id) selected="selected" @endif >
                                                        {{$item->district_name}}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="">Quận/Huyện</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="personal__col">
                                    <div class="personal__item">
                                        <span class="name__dots">Phường/Xã* </span>
                                        <select class="wards fr__ward_id" name="ward_id">
                                            @if($wards != null)
                                                @foreach($wards as $item)
                                                    <option value="{{$item->id}}" @if($auth->ward_id == $item->id) selected="selected" @endif>
                                                        {{$item->ward_name}}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="">Phường/Xã</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="personal__col">
                                    <div class="personal__item">
                                        <span class="name__dots">Địa chỉ cụ thể* </span>
                                        <input type="text" name="address" value="{{$auth->address}}" class="fr__address" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info__group">
                <div class="card contact__card">
                    <h2 class="title__global">Thông tin liên hệ</h2>
                    <div class="contact__form">
                        <div class="contact__row">
                            <div class="contact__col">
                                <label for="" class="name__global">
                                    Số điện thoại*</label>
                                <input type="text" value="{{$auth->phone}}" readonly />
                            </div>
                            <div class="contact__col">
                                <label for="" class="name__global">Email*</label>
                                <input type="email" value="{{$auth->email}}" readonly />
                            </div>
                            <div class="contact__col">
                                <label for="" class="name__global">Mã số thuế/<br />
                                    CMND/CCC</label>
                                <input type="text" value="{{$auth->cmnd}}" name="cmnd" />
                            </div>
                        </div>
                        <div class="contact__row contact__row-link">
                            <div class="contact__col">
                                <label for="facebook" class="radio__cus">
                                    <input type="radio" class="radio__input" name="facebok" value="{{$auth->facebok}}" id="facebook" checked />
                                    <span class="radio__name">Facebook</span>
                                </label>

                                <input type="text" name="facebook" value="{{$auth->facebook}}" />
                            </div>
                            <div class="contact__col">
                                <label for="zalo" class="radio__cus">
                                    <input type="radio" class="radio__input" id="zalo" checked />
                                    <span class="radio__name">Zalo</span>
                                </label>

                                <input type="text" name="zalo" value="{{$auth->zalo}}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card avatar__card">
                    <h2 class="title__global">Ảnh đại diện</h2>
                    <label for="file" class="upload__file">
                        <input type="file" class="input__file" name="file" id="file" />
                        <div class="frame__file">
                            <img src="{{url('/').'/public/images/avatar/'.$auth->image}}" alt="{{$auth->name}}" class="frame__image avatar__user" />
                        </div>
                        <div class="frame__icon">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                        </div>
                    </label>
                </div>
            </div>
            <div class="control__group">
                <button type="button" class="btn btn__save btn__aupdate__account">Cập nhập</button>
                <button class="btn btn__cancel">Huỷ</button>
            </div>
        </form>
    </main>
    @section('scrip-admin')
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/toastr.min.js"></script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/custom.js"></script>
    <script>

        var base_url = '{{url('/')}}';

        $(document).ready(function() {
            $(".city__​​province").select2({
                placeholder: "--Tỉnh/Thành phố--",
            });
            $(".district").select2({
                placeholder: "--Quận/Huyện--",
            });
            $(".wards").select2({
                placeholder: "--Phường/Xã*--",
            });

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

        });
    </script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/custom2.js"></script>
    @endsection
@stop