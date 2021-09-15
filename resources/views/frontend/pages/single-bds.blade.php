<?php 
	if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	}
 ?>
@section('css')
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/detail__real-estate.css" />
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/cm__detail.css" />
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/cm__product.css" />
@endsection
@extends('frontend.master')
@section('main')
    <style>
        .fb_iframe_widget_fluid_desktop, .fb_iframe_widget_fluid_desktop span, .fb_iframe_widget_fluid_desktop iframe {
                max-width: 100% !important;
                width: 100% !important;
    }
    </style>
    <main id="main">
        <section class="detail__real-estate">
            <div class="container">
                <div class="detail__global">
                    <div class="detail__address">
                        {{getAddress($bdsDetail->city_id,$bdsDetail->district_id,$bdsDetail->ward_id)}}
                    </div>
                    <div class="detail__grid">
                        <h1 class="detail__title">{{$bdsDetail->title}}</h1>
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{route('home.index')}}" title="Trang chủ"> Trang chủ </a>
                            </li>
                            <li>
                                <a href="{{route('home.bds')}}" title="Bất động sản">
                                    Bất động sản
                                </a>
                            </li>
                            <li>
                                <a href="" title="{{$bdsDetail->title}}">
                                    {{$bdsDetail->title}}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="group__info">
                        <div class="info__item">
                            <div class="detail__total">
                                <span> {{ number_format($bdsDetail->price,0, '.', '.') }}VND </span>
                                <span> {{ number_format($bdsDetail->price2,0, '.', '.') }}VND/m² </span>
                            </div>
                            <div class="us__group">
                                <div class="us__container">
                                    <h3 class="us__title">Liên hệ người bán</h3>
                                    <div class="us__box">
                                        <div class="us__avatar">
                                            <img src="{{url('/').'/public/images/avatar/'.@$bdsDetail->getMemberDetai(@$bdsDetail->customer_id)->image}}" alt="us__1.png" />
                                        </div>
                                        <div class="us__content">
                                            <h3 class="us__name">{{@$bdsDetail->getMemberDetai(@$bdsDetail->customer_id)->name}}</h3>
                                            <div class="use__tag">
                                                <span> {{@$bdsDetail->getMemberDetai(@$bdsDetail->customer_id)->object}} </span>
                                                <span> Số tin đăng: {{@$bdsDetail->getCountBds(@$bdsDetail->customer_id)}} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="us__contact">
                                    <div class="us__contact-item">
                                        <span> 036 9560 *** </span>
                                        <span class="click__show"> Ấn để hiện số </span>
                                    </div>
                                    <div class="us__contact-item">
                                        <img src="{{url('/')}}/public/images/icons/icon__zalo.png" alt="icon__zalo.png" />
                                        Zalo
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info__item">
                            <div class="info__tag">
                                
                                <div class="tag__item">
                                    <span class="tag__icon">
                                        <img src="{{url('/')}}/public/images/icons/tag__1.png" alt="tag__1.png" />
                                    </span>
                                    <span class="tag__text"> Diện tích: {{$bdsDetail->land_area}} m² </span>
                                </div>
                                @if(!empty($bdsDetail->direction_house))
                                <div class="tag__item">
                                    <span class="tag__icon">
                                        <img src="{{url('/')}}/public/images/icons/tag__2.png" alt="tag__2.png" />
                                    </span>
                                    <span class="tag__text"> Hướng: {{huongNha($bdsDetail->direction_house)}} </span>
                                </div>
                                @endif
                                @if(!empty($bdsDetail->legal_papers))
                                <div class="tag__item">
                                    <span class="tag__icon">
                                        <img src="{{url('/')}}/public/images/icons/tag__3.png" alt="tag__3.png" />
                                    </span>
                                    <span class="tag__text">
                                        Giấy tờ pháp lý: {{$bdsDetail->legal_papers}}
                                    </span>
                                </div>
                                @endif
                                @if(!empty($bdsDetail->bedroom))
                                <div class="tag__item">
                                    <span class="tag__icon">
                                        <img src="{{url('/')}}/public/images/icons/tag__4.png" alt="tag__4.png" />
                                    </span>
                                    <span class="tag__text"> Số phòng ngủ: {{$bdsDetail->bedroom}} </span>
                                </div>
                                @endif
                                @if(!empty($bdsDetail->bathroom))
                                <div class="tag__item">
                                    <span class="tag__icon">
                                        <img src="{{url('/')}}/public/images/icons/tag__5.png" alt="tag__5.png" />
                                    </span>
                                    <span class="tag__text"> Số phòng tắm: {{$bdsDetail->bathroom}} </span>
                                </div>
                                @endif
                                <!-- <div class="tag__item">
                                    <span class="tag__icon">
                                        <img src="{{url('/')}}/public/images/icons/tag__6.png" alt="tag__6.png" />
                                    </span>
                                    <span class="tag__text">
                                        Tình trạng:
                                        <span class="text__red"> Đang mở bán </span>
                                    </span>
                                </div> -->
                            </div>
                            <div class="info__desc">
                                {!! $bdsDetail->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="map__album">
                <div class="album">
                    @if(!empty($bdsDetail->more_image))
                        @php $images = json_decode($bdsDetail->more_image); @endphp
                        @foreach($images as $image)
                        <div class="frame">
                            <img src="{{url('/').'/public/images/bds/'.$image}}" alt="{{$bdsDetail->title}}" />
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="map">
                    <div class="frame">
                        <iframe src="https://maps.google.com/maps?q={{getAddress($bdsDetail->city_id,$bdsDetail->district_id,$bdsDetail->ward_id)}}&ie=UTF8&iwloc=&hl=vi&output=embed" width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="detail">
                    <h2 class="detail__title">Thông tin chi tiết</h2>
                    <div class="detail__time">
                        <time class="item"> Ngày đăng: {{format_datetime($bdsDetail->startDate,'d/m/Y')}} </time>
                        <time class="item"> Ngày hết hạn: {{format_datetime($bdsDetail->endDate,'d/m/Y')}} </time>
                    </div>
                    <div class="detail__share">
                        <a href="#" class="share__item">
                            <img src="{{url('/').'/public/images/'}}icons/share__1.png" alt="share__1.png" />
                        </a>
                        <a href="#" class="share__item">
                            <img src="{{url('/').'/public/images/'}}icons/share__4.png" alt="share__4.png" />
                        </a>
                        <a href="#" class="share__item">
                            <img src="{{url('/').'/public/images/'}}icons/share__2.png" alt="share__2.png" />
                        </a>
                        <a href="#" class="share__item">
                            <img src="{{url('/').'/public/images/'}}icons/share__3.png" alt="share__3.png" />
                        </a>
                    </div>
                    <div class="detail__tag">
                        <p><b>Loại nhà đất:</b> Chung cư</p>
                        <p><b>Đối tượng:</b> {{$bdsDetail->object}}</p>
                        <!-- <p><b>Mặt tiền:</b> --</p>
                        <p><b>Đường rộng:</b> Ngõ 2 ô tô</p> -->
                    </div>
                    <div class="detail__desc">
                        {!! $bdsDetail->content !!}
                    </div>
                    @if($project !=null)
                    <div class="detail__porject">
                        <div class="project__header">
                            <h3 class="project__title">Thông tin dự án</h3>
                            <a href="{{route('home.single-project',['slug'=>$project->slug])}}" class="btn btn__global"> Chi tiết </a>
                        </div>
                        <div class="project__body">
                            <p>
                                <b>{{$project->name}}</b>
                            </p>
                            <p>Chủ đầu tư: {{$project->getCompany($project->company_id)->name}}</p>
                            <!-- <p>Quy mô: 16 block cao 20 tầng</p> -->
                        </div>
                    </div>
                    @endif

                    <div class="facebook__comment">
                        <div class="fb-box">
                            <div class="fb-comments" data-href="{{url()->current()}}" data-width="100%" data-numposts="3"></div>
                        </div>
                    </div>
                    <ul class="tag">
                        <li>
                            <a href="#"> Bán Căn hộ Takashi Ocean Suite Kỳ Co </a>
                        </li>
                        <li>
                            <a href="#" class="text__red">
                                Căn hộ Takashi Ocean Suite Kỳ Co
                            </a>
                        </li>
                        <li>
                            <a href="#"> Căn hộ Takashi Ocean Suite </a>
                        </li>
                        <li>
                            <a href="#"> Bán Căn hộ Takashi Ocean Suite </a>
                        </li>
                        <li>
                            <a href="#">Căn hộ Takashi Ocean Suite </a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="product__similar">
            <div class="container">
                <div class="header__global">
                    <div class="item__global">
                        <h1 class="title__global">Tin đăng tương tự</h1>
                    </div>
                </div>
                <div class="module__content">
                    <div class="slide__product">
                        @foreach($bdsSame as $item)
                        <div class="slide__item">
                            <div class="slide__box">
                                <div class="product__global">
                                    <a href="detail__real-estate.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang">
                                        <div class="frame">
                                            <img src="{{url('/').'/public/images/'}}product__1.jpg" alt="product__1.jpg" />
                                        </div>
                                        <span class="price__global"> 2.15 Tỷ </span>
                                    </a>
                                    <div class="content__global">
                                        <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps">
                                            {{getAddress($item->city_id,$item->district_id,$item->ward_id)}}
                                        </a>
                                        <h3 class="title__global">
                                            <a href="detail__real-estate.html" title="Căn hộ Officetel Sky Center Phổ Quang">
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
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>

    @section('script')
	<script>

$(document).ready(function() {
                $(".album").slick({
                    dost: false
                });
                similarProduct = () => {
                    $(".slide__product").slick({
                        dots: false,
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        arrows: false,
                        autoplay: true,
                        responsive: [{
                                breakpoint: 991.98,
                                settings: {
                                    slidesToShow: 3,
                                    slidesToScroll: 3,
                                },
                            },
                            {
                                breakpoint: 600,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 2,
                                },
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                },
                            },
                        ],
                    });
                };
                similarProduct();
            });

    </script>
    @endsection
@endsection