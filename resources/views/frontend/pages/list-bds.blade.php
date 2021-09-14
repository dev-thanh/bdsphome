<?php 
	$curent_page = request()->get('page') ? request()->get('page') : '1';
	if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	}
 ?>
@section('css')
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/page__real-estate.css" />
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/cm__filter.css" />
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/cm__product.css" />
@endsection
@extends('frontend.master')
@section('main')

    <main id="main">
        <section class="page__banner" style="background-image:url('images/slide__1.jpg')">
            <div class="container">
                <div class="header__global">
                    <div class="item__global">
                        <h1 class="title__global">Bất động sản</h1>
                    </div>
                    <ul class="breadcrumb">
                        <li>
                            <a href="index.html" title="Trang chủ">
                                Trang chủ
                            </a>

                        </li>
                        <li>
                            <a href="page__realEstate.html" title="Bất động sản">
                                Bất động sản
                            </a>

                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="control__global">
            <div class="container">
                <div class="bs-tab">
                    <div class="tab-container">
                        <div class="tab-control">
                            <ul class="control-list">
                                <li class="control-list__item active" tab-show="#real-estate">
                                    Bất động sản
                                </li>
                                <li class="control-list__item " tab-show="#project">
                                    Dự án
                                </li>
                                <li class="control-list__item " tab-show="#news">
                                    Tin tức
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-item  active" id="real-estate">
                                <form class="form__control">
                                    <div class="form__header">
                                        <div class="form__item">
                                            <select class="select__control">
                                                <option value="1">
                                                    Loại Bất động sản
                                                </option>
                                                <option value="">Nhà phố</option>
                                                <option value="">Đất nền</option>
                                                <option value="">
                                                    Căn hộ chung cư
                                                </option>
                                                <option value="">
                                                    Đất bất động sản nghỉ dưỡng
                                                </option>
                                                <option value="">
                                                    Đất xây nhà xưởng, khu công nghiệp.
                                                </option>
                                                <option value="">
                                                    Đất nghĩa trang.
                                                </option>
                                            </select>
                                            <div class="form__checkout">
                                                <label for="check__1">
                                                    <input type="radio" class="input__raido" checked="checked" id="check__1" name="name__radio" />
                                                    <span class="checked">
                                                        Bán
                                                    </span>
                                                </label>
                                                <label for="check__2">
                                                    <input type="radio" class="input__raido" id="check__2" name="name__radio" />
                                                    <span class="checked">
                                                        Cho thuê
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form__item">
                                            <div class="form__search">
                                                <input type="text" class="input__search" placeholder="Nhập từ khoá cần tìm..." />
                                                <button class="btn btn__search">
                                                    <img src="images/icons/icon__search.png" alt="icon__search.png" />
                                                    Tìm kiếm
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form__body">
                                        <div class="form__item">
                                            <select class="select__control">
                                                <option value="0">Tỉnh/Thành</option>
                                                <option value="1">Hà Nội</option>
                                                <option value="2">Hưng Yên</option>
                                                <option value="3">Vĩnh Phúc</option>
                                                <option value="4">Hòa Bình</option>
                                                <option value="5">Mộc châu</option>
                                            </select>
                                        </div>
                                        <div class="form__item">
                                            <select class="select__control">
                                                <option value="0">Quận/Huyện</option>
                                                <option value="1">Thạch Thất</option>
                                                <option value="2">Đan Phượng</option>
                                                <option value="3">Sơn Tây</option>
                                                <option value="4">Quốc Oai</option>
                                            </select>
                                        </div>
                                        <div class="form__item">
                                            <select class="select__control">
                                                <option value="0">Phường/Xã</option>
                                                <option value="1">Hương Ngải</option>
                                                <option value="2">Kim Quan</option>
                                            </select>
                                        </div>
                                        <div class="form__item">
                                            <select class="select__control">
                                                <option value="0">Khoảng Giá</option>
                                                <option value="1">1 tỷ - 2 tỷ</option>
                                                <option value="2">
                                                    3 tỷ - 4 tỷ/option>
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form__item action ">
                                            <button type="button" class="btn btn__click">
                                                Thu gọn
                                            </button>
                                            <button type="reset" class="btn btn__reset">
                                                <img src="images/icons/icon__reset.png" alt="icon__reset.png" />
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form__footer active">
                                        <div class="form__item">
                                            <select class="select__control">
                                                <option value="0">Diện tích</option>
                                                <option value="1">67 m²</option>
                                                <option value="2">67 m²</option>
                                            </select>
                                        </div>
                                        <div class="form__item">
                                            <select class="select__control">
                                                <option value="0">Hướng</option>
                                            </select>
                                        </div>
                                        <div class="form__item">
                                            <select class="select__control">
                                                <option value="0">Số phòng ngủ</option>
                                            </select>
                                        </div>
                                        <div class="form__item">
                                            <select class="select__control">
                                                <option value="0">Dự án</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-item " id="project">
                                <form class="form__control">
                                    <div class="form__header">
                                        <div class="form__item">
                                            <select class="select__control">
                                                <option value="1">
                                                    Đang khởi động
                                                </option>
                                                <option value="">Nhà phố</option>
                                                <option value="">Đất nền</option>
                                                <option value="">
                                                    Căn hộ chung cư
                                                </option>
                                                <option value="">
                                                    Đất bất động sản nghỉ dưỡng
                                                </option>
                                                <option value="">
                                                    Đất xây nhà xưởng, khu công nghiệp.
                                                </option>
                                                <option value="">
                                                    Đất nghĩa trang.
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form__item">
                                            <div class="form__search">
                                                <input type="text" class="input__search" placeholder="Nhập từ khoá cần tìm..." />
                                                <button class="btn btn__search">
                                                    <img src="images/icons/icon__search.png" alt="icon__search.png" />
                                                    Tìm kiếm
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-item " id="news">
                                <form class="form__control">
                                    <div class="form__header">
                                        <div class="form__item">
                                            <select class="select__control">
                                                <option value="1">
                                                    Tin động sản
                                                </option>
                                                <option value="">Nhà phố</option>
                                                <option value="">Đất nền</option>
                                                <option value="">
                                                    Căn hộ chung cư
                                                </option>
                                                <option value="">
                                                    Đất bất động sản nghỉ dưỡng
                                                </option>
                                                <option value="">
                                                    Đất xây nhà xưởng, khu công nghiệp.
                                                </option>
                                                <option value="">
                                                    Đất nghĩa trang.
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form__item">
                                            <div class="form__search">
                                                <input type="text" class="input__search" placeholder="Nhập từ khoá cần tìm..." />
                                                <button class="btn btn__search">
                                                    <img src="images/icons/icon__search.png" alt="icon__search.png" />
                                                    Tìm kiếm
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="page-realesate">
            <div class="container">
                <div class="filter__group">
                    <div class="filter__item">
                        <label for="" class="filter__name">
                            Sắp xếp theo
                        </label>
                        <select class="filter__select">
                            <option value="">Mới nhất</option>
                        </select>
                    </div>
                    <div class="filter__item">

                        <select class="filter__select">
                            <option value="">Căn hộ chung cư</option>
                        </select>
                    </div>
                </div>

                <div class="realesate__one">
                    <div class="product__global">
                        <a href="{{route('home.single-bds',['slug'=>$listBds[0]->slug])}}" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang">
                            <div class="frame">
                                <img src="{{url('/').'/public/images/bds/'.$listBds[0]->image}}" alt="product__1.jpg" />
                            </div>
                            <span class="price__global">
                                2.15 Tỷ
                            </span>
                        </a>
                        <div class="content__global">
                            <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps">
                                {{getAddress($listBds[0]->city_id,$listBds[0]->district_id,$listBds[0]->ward_id)}}
                            </a>
                            <h3 class="title__global">
                                <a href="{{route('home.single-bds',['slug'=>$listBds[0]->slug])}}" title="{{$listBds[0]->title}}">
                                    {{$listBds[0]->title}}
                                </a>
                            </h3>
                            <div class="tags__group">
                                <span class="tags__item">
                                    {{$listBds[0]->land_area}} m²
                                </span>
                                @if($listBds[0]->frontispiece)
                                <span class="tags__item">
                                    {{$listBds[0]->frontispiece}}
                                </span>
                                @endif
                                @if($listBds[0]->bedroom)
                                <span class="tags__item">
                                    {{$listBds[0]->bedroom}} Phòng ngủ
                                </span>
                                @endif
                                @if($listBds[0]->number_floors)
                                <span class="tags__item">
                                    {{$listBds[0]->number_floors}} tầng
                                </span>
                                @endif
                            </div>
                            <div class="tags__group">
                                @if(!empty($listBds[0]->direction_house))
                                <span class="tags__item">
                                    {{huongNha($listBds[0]->direction_house)}}
                                </span>
                                @endif
                                @if(!empty($listBds[0]->legal_papers))
                                <span class="tags__item">{{$listBds[0]->legal_papers}}
                                </span>
                                @endif
                            </div>
                            <div class="desc__global">
                                {!! $listBds[0]->content !!}
                            </div>
                            <a href="{{route('home.single-bds',['slug'=>$listBds[0]->slug])}}" class="btn btn__global" title="Chi tiết">
                                Chi tiết
                            </a>
                        </div>
                    </div>
                </div>
                <div class="realesate__group">
                    @foreach($listBds as $k => $item)
                    @if($k != 0)
                    <div class="product__global">
                        <a href="detail__real-estate.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                            <div class="frame">
                                <img src="{{url('/').'/public/images/bds/'.$item->image}}" alt="product__1.jpg">
                            </div>
                            <span class="price__global">
                                2.15 Tỷ
                            </span>
                        </a>
                        <div class="content__global">
                            <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                            {{getAddress($item->city_id,$item->district_id,$item->ward_id)}}
                            </a>
                            <h3 class="title__global">
                                <a href="detail__real-estate.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                    {{$item->title}}
                                </a>
                            </h3>
                            <div class="tags__group">
                                <span class="tags__item">
                                        {{$item->land_area}} m²
                                    </span>
                                    @if($item->frontispiece)
                                    <span class="tags__item">
                                        {{$item->frontispiece}}
                                    </span>
                                    @endif
                                    @if($item->bedroom)
                                    <span class="tags__item">
                                        {{$item->bedroom}} Phòng ngủ
                                    </span>
                                    @endif
                                    @if($item->number_floors)
                                    <span class="tags__item">
                                        {{$item->number_floors}} tầng
                                    </span>
                                    @endif
                            </div>
                            <div class="tags__group">
                                @if(!empty($item->direction_house))
                                <span class="tags__item">
                                    {{huongNha($item->direction_house)}}
                                </span>
                                @endif
                                @if(!empty($item->legal_papers))
                                <span class="tags__item">{{$item->legal_papers}}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <!-- <ul class="addon__pagination">
                    <li class="addon__pagination-item">
                        <a href="#" class="addon__pagination-item-link">
                            <img src="images/admin/icon__prev.png" alt="icon__next.png">
                        </a>
                    </li>
                    <li class="addon__pagination-item active">
                        <a href="#" class="addon__pagination-item-link">1</a>
                    </li>
                    <li class="addon__pagination-item">
                        <a href="#" class="addon__pagination-item-link">2</a>
                    </li>
                    <li class="addon__pagination-item">
                        <a href="#" class="addon__pagination-item-link">3</a>
                    </li>
                    <li class="addon__pagination-item">
                        <a href="#" class="addon__pagination-item-link addon__next">
                            <img src="images/admin/icon__next.png" alt="icon__next.png">
                        </a>
                    </li>
                </ul> -->
            </div>
        </section>
    </main>
@endsection