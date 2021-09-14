@section('css')
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0&appId=1472426692944496&autoLogAppEvents=1" nonce="cRcsDDJ3"></script>
	<link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/detail__news.css" />
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
                        {{$data->address}}
                    </div>
                    <div class="detail__grid">
                        <h1 class="detail__title">{{$data->name}}</h1>
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{route('home.index')}}" title="Trang chủ"> Trang chủ </a>
                            </li>
                            <li>
                                <a href="{{route('home.projects')}}" title="Dự án">
                                    Dự án
                                </a>
                            </li>
                            <li>
                                <a href="" title="{{$data->name}}">
                                    {{$data->name}}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="group__info">
                        <div class="info__item">
                            <div class="detail__total">
                                <span> {{$data->price}} </span>
                                <span> {{$data->price2}} </span>
                            </div>
                            <div class="us__group">
                                <div class="us__container">
                                    <h3 class="us__title">Liên hệ người bán</h3>
                                    <div class="us__box">
                                        <div class="us__avatar">
                                            <img src="{{url('/').@$data->getCompany($data->company_id)->image}}" alt="Ellipse 1.png" />
                                        </div>
                                        <div class="us__content">
                                            <h3 class="us__name">
                                                {{$data->getCompany($data->company_id)->name}}
                                            </h3>
                                            <div class="use__tag">
                                                <span> Chủ đầu tư </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="us__contact">
                                    <div class="us__contact-item">
                                        <span> {{$data->getCompany($data->company_id)->phone}} </span>
                                        <span class="click__show"> Ấn để hiện số </span>
                                    </div>
                                    <div class="us__contact-item">
                                        <img src="{{url('/')}}/public/images/icons/messenger.png" alt="messenger.png" />
                                        Chat với chăm sóc khách hàng
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info__item">
                            @php 
                                if(!empty($data->desc)){
                                    $descs = json_decode($data->desc);
                                } 
                                if(!empty($data->more_image)){
                                    $images = json_decode($data->more_image);
                                }
                                if(!empty($data->content)){
                                    $contents = json_decode($data->content);
                                }
                            @endphp
                            @if($descs)
                            <ul>
                                @foreach($descs as $item)
                                    @if($loop->first)
                                    <li>
                                        <span> {{$item->title}} </span>
                                        <span>
                                            {{$item->value}}
                                        </span>
                                    </li>
                                    @else
                                    <li>{{$item->title}} {{$item->value}}</li>
                                    @endif
                                @endforeach
                                <!-- <li>
                                    Tình trạng:
                                    <span class="text__red"> Đang mở bán </span>
                                </li> -->
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                @if(isset($images))
                <div class="map__album">
                    <div class="album album__2">
                        @foreach($images as $item)
                        <div class="frame">
                            <img src="{{url('/').$item}}" alt="{{$data->name}}" />
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="detail w__container">
                    @if(isset($contents))
                    <ul class="scrollink">
                        @foreach($contents as $k => $item)
                            @if(!empty($item->tab_content))
                            <li>
                                <a href="#link__{{$k}}">
                                    {{@$item->tab_content->title}}
                                </a>
                            </li>
                            @endif
                            @if(!empty($item->slide))
                            <li>
                                <a href="#link__{{$k}}">
                                    {{@$item->slide->title}}
                                </a>
                            </li>
                            @endif
                        @endforeach
                        @if(count($bds))
                            <li>
                                <a href="#link__tdda">
                                    Tin đăng dự án
                                </a>
                            </li>
                        @endif
                    </ul>
                    @endif

                    @if(isset($contents))
                        @foreach($contents as $k => $item)
                            @if(!empty(@$item->tab_content))
                            <h2 id="link__{{$k}}">{{$item->tab_content->title}}</h2>
                            @if($loop->first)
                            <div class="detail__share">
                                <a href="#" class="share__item">
                                    <img src="{{url('/')}}/public/images/icons/share__1.png" alt="share__1.png" />
                                </a>
                                <a href="#" class="share__item">
                                    <img src="{{url('/')}}/public/images/icons/share__4.png" alt="share__4.png">
                                </a>
                                <a href="#" class="share__item">
                                    <img src="{{url('/')}}/public/images/icons/share__2.png" alt="share__2.png" />
                                </a>
                                <a href="#" class="share__item">
                                    <img src="{{url('/')}}/public/images/icons/share__3.png" alt="share__3.png" />
                                </a>
                            </div>
                            @endif
                            <div class="detail__desc">
                                {!! @$item->tab_content->content !!}
                            </div>
                            <hr />
                            @endif
                            @if(!empty(@$item->slide))
                            <h2 id="link__{{$k}}">{{@$item->slide->title}}</h2>
                            <div class="map__album">
                                <div class="album album__2">
                                    @foreach(@$item->slide->gallery as $image)
                                    <div class="frame">
                                        <img src="{{url('/').@$image}}" alt="{{@$item->slide->title}}" />
                                    </div>
                                   @endforeach
                                </div>
                            </div>
                            <hr />
                            @endif
                        @endforeach
                    @endif
                    @if(count($bds))
                    <section id="link__tdda" class="product__similar">
                        <div class="header__global">
                            <div class="item__global">
                                <h1 class="title__global">Tin đăng dự án</h1>
                            </div>
                        </div>
                        <div class="module__content">
                            <div class="slide__product">
                                @foreach($bds as $item)
                                <div class="slide__item">
                                    <div class="slide__box">
                                        <div class="product__global">
                                            <a href="detail__project.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang">
                                                <div class="frame">
                                                    <img src="{{url('/').'/public/images/bds/'.$item->image}}" alt="{{$item->title}}" />
                                                </div>
                                                <span class="price__global">
                                                    2.15 Tỷ
                                                </span>
                                            </a>
                                            <div class="content__global">
                                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps">
                                                    {{getAddress($item->city_id,$item->district_id,$item->ward_id)}}
                                                </a>
                                                <h3 class="title__global">
                                                    <a href="detail__project.html" title="{{$item->title}}">
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
                    </section>
                    @endif
                    <div class="facebook__comment">
                        <div class="fb-box">
                        <div class="fb-comments" data-href="{{url()->current()}}" data-width="100%" data-numposts="3"></div>
                        </div>
                    </div>
                    <!-- <ul class="tag">
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
                    </ul> -->
                </div>
            </div>
        </section>

    </main>
@endsection
@section('script')
	<script>
		$(document).ready(function() {
			$(".album").slick({
                dost: false
            });
            similarProduct = () => {
                $(".slide__product").slick({
                    dots: false,
                    slidesToShow: 3,
                    slidesToScroll: 2,
                    arrows: false,
                    autoplay: true,
                    responsive: [{
                            breakpoint: 991.98,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 2,
                            },
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
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

            function ClickShow() {
                $("a[href*='#']:not([href='#]").on("click", function(event) {
                    if (this.hash !== "") {
                        event.preventDefault();
                        var hash = this.hash;
                        var top = $(hash).offset().top;

                        $("html, body").animate({
                                scrollTop: top - 150,
                            },
                            800,
                            function() {
                                window.location.hash = hash + 150;
                            }
                        );
                    }
                });
            }
            ClickShow();
		});
	</script>
@endsection