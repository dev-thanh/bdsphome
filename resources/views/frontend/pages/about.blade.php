@extends('frontend.master')
@section('main')
	<?php 
		if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
		//dd($content);
	} ?>

	<main id="main" class="main-category">
	    <section class="category__banner">
	        <img class="category__banner--img" src="{{url('/')}}/{{@$dataSeo->banner}}" alt="{{@$dataSeo->name_page}}">
	        <h2 class="category__banner--title">
	            {{@$dataSeo->name_page}}
	        </h2>
	    </section>
	    <section class="page__introduce">
	        <div class="container">
	            <div class="module module-page__introduce">
	                <div class="module__content">
	                    <div class="introduce">
	                        {!! @$content->introduce->content !!}
	                    </div>
	                    <div class="addon__relateto">
	                        <h2 class="addon__relateto--title">
	                            SẢN PHẨM nổi bật
	                        </h2>
	                        <div class="addon__relateto--slide2">
	                        	@foreach($products_hot as $item)
	                            <div class="addon__relateto--item">
	                                <div class="addon__relateto__box">
	                                    <div class="product">
	                                        <div class="box">
	                                            <a href="{{route('home.single.product',['slug'=>$item->slug])}}" class="avata" title="{{$item->name}}">
	                                            <img class="avata__image" src="{{url('/')}}/{{$item->image}}" alt="{{$item->name}}">
	                                            </a>
	                                            <div class="product__content">
	                                                <h3 class="product__title">
	                                                    <a href="{{route('home.single.product',['slug'=>$item->slug])}}" class="product__link"
	                                                        title="{{$item->name}}">
	                                                    	{{$item->name}}
	                                                    </a>
	                                                </h3>
	                                                <div class="product__cost">
	                                                    @if ($item->regular_price != 0)
					                                        @if($item->sale_price !='')
				                                                <span class="text__through">{{ number_format($item->regular_price,0, '.', '.') }}đ</span>
						                                        <span class="price__red">
						                                        {{ number_format($item->sale_price,0, '.', '.') }}đ
						                                        </span>
					                                        @else
					                                        	<span class="price__red">{{ number_format($item->regular_price,0, '.', '.') }}đ</span>
					                                        @endif
		                                            	@else
		                                            		<span class="price__red">Liên hệ</span>
				                                        @endif
	                                                </div>
	                                                <div class="text__right">
	                                                    <a href="{{route('home.single.product',['slug'=>$item->slug])}}" class="link__view"
	                                                        title="XE ĐẠP ĐIỆN GIANT M133 S10">
	                                                    Xem chi tiết
	                                                    </a>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            @endforeach
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>
	</main>

	@section('script')
	<script>
	    $(document).ready(function () {
	        function slideRelateto() {
	            $('.addon__relateto--slide2').slick({
	                dots: false,
	                infinite: true,
	                speed: 300,
	                slidesToShow: 4,
	                slidesToScroll: 1,
	                arrows: true,
	                autoplay: true,

	                responsive: [
	                    {
	                        breakpoint: 1024,
	                        settings: {
	                            slidesToShow: 3,
	                            slidesToScroll: 3,
	                            infinite: true,
	                            dots: true
	                        }
	                    },
	                    {
	                        breakpoint: 600,
	                        settings: {
	                            slidesToShow: 2,
	                            slidesToScroll: 2
	                        }
	                    },
	                    {
	                        breakpoint: 480,
	                        settings: {
	                            slidesToShow: 1,
	                            slidesToScroll: 1
	                        }
	                    }
	                ]
	            });

	        }
	        slideRelateto();
	    })
	</script>
	@endsection
@endsection