@extends('frontend.master')
@section('main')

	<?php if(!empty($contentHome)){
		$content = json_decode($contentHome->content);
	} ?>
	
	<main id="main">
		@if(count($slider))
		<section class="section__banner">
			<div class="banner__slide" data-aos="fade-up"
				data-aos-duration="3000">
				@foreach($slider as $item)
				<div class="banner__item">
					<a href="{{$item->link}}" target="_blank" class="banner__item--link">
					<img src="{{url('/').$item->image}}" alt="{{$item->name}}"/>
					</a>
				</div>
				@endforeach
			</div>
		</section>
		@endif
		@if(count($product_selling))
		<section class="home__product">
			<div class="container">
				<div class="module module-home__product">
					<div class="module__header header__global" data-aos="fade-up" data-aos-duration="3000">
						<h2 class="title">hàng bán chạy</h2>
						<a href="{{route('home.list.product')}}" class="btn btn__all">
						Tất cả
						</a>
					</div>
					<div class="module__content">
						<div class="row">
							@foreach($product_selling as $item)
							
							<div class="col-12 col-xs-6 col-sm-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-duration="3000">
								<div class="product__global">
									<div class="product__avata-global">
										<a href="{{route('home.single.product',['slug'=>$item->slug])}}" class="frame" title="{{$item->name}}">
										<img class="img__global" src="{{url('/').$item->image}}" alt="{{$item->name}}"/>
										<img class="img__hover-global" src="{{url('/').$item->image_hover}}" alt="{{$item->name}}"/>
										</a>
									</div>
									<div class="product__content-global">
										<div class="product__function-global">
											<?php $cate = $item->category;
												$string1 = '';
												foreach($cate as $k => $val){
													if($k!=0){
														$string1=$string1.', '.$val->name;
													}else{
														$string1=$string1.$val->name;
													}
												}
											?>
											{{$string1}}
										</div>
										<h3 class="product__title-global">
											<a href="{{route('home.single.product',['slug'=>$item->slug])}}" title="{{$item->name}}">
											{{$item->name}}
											</a>
										</h3>
										<div class="product__price-global">
											<span class="global__price">
											{{ number_format($item->regular_price,0, '.', '.') }}VND
											</span>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</section>
		@endif
		@if(!empty($content->aboutus) || !empty($content->fashion))
		<section class="home__store">
			<div class="container">
				<div class="module module-home__store">
					<div class="module__content">
						<div class="store__group">
							<div class="store__item">
								<div class="store__content">
									<h3 class="store__title" data-aos="fade-up" data-aos-duration="3000">{{$content->aboutus->title}}</h3>
									<div class="store__desc" data-aos="fade-up" data-aos-duration="3000">
										{!! $content->aboutus->desc !!}
									</div>
									<a href="{{@$content->aboutus->link}}" title="{{$content->aboutus->title}}" class="btn btn__store" data-aos="fade-up" data-aos-duration="3000">
									Cửa hàng
									</a>
								</div>
							</div>
							<div class="store__item">
								<div class="store__thumbnail">
									<div class="frame" data-aos="fade-up" data-aos-duration="3000">
										<img src="{{url('/').$content->aboutus->iamge}}" alt="{{$content->aboutus->title}}"/>
									</div>
								</div>
							</div>
						</div>
						@if(!empty($content->fashion))
						<div class="store__group">
							<div class="store__item">
								<div class="store__content">
									<h3 class="store__title" data-aos="fade-up" data-aos-duration="3000">{{$content->fashion->title}}</h3>
									<div class="store__desc" data-aos="fade-up" data-aos-duration="3000">
										{!! $content->fashion->desc !!}
									</div>
									<a href="{{$content->fashion->link}}" class="btn btn__store" data-aos="fade-up" data-aos-duration="3000">
									Cửa hàng
									</a>
								</div>
							</div>
							<div class="store__item">
								<div class="store__thumbnail">
									<div class="frame" data-aos="fade-up" data-aos-duration="3000">
										<img src="{{url('/').$content->fashion->iamge}}" alt="{{$content->aboutus->title}}"/>
									</div>
								</div>
							</div>
						</div>
						@endif
					</div>
				</div>
			</div>
		</section>
		@endif
		@if(count($product_hot))
		<section class="home__product">
			<div class="container">
				<div class="module module-home__product">
					<div class="module__header header__global" data-aos="fade-up" data-aos-duration="3000">
						<h2 class="title">hàng nổi bật</h2>
						<a href="{{route('home.list.product')}}" class="btn btn__all">
						Tất cả
						</a>
					</div>
					<div class="module__content">
						<div class="row">
							@foreach($product_hot as $item)
							<div class="col-12 col-xs-6 col-sm-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-duration="3000">
								<div class="product__global">
									<div class="product__avata-global">
										<a href="{{route('home.single.product',['slug'=>$item->slug])}}" class="frame" title="{{ $item->name }}">
										<img class="img__global img--bc" src="{{ url('/').$item->image }}" alt="{{ $item->name }}"/>
										<img class="img__hover-global" src="{{ url('/').$item->image_hover }}" alt="{{ $item->name }}"/>
										</a>
									</div>
									<div class="product__content-global pcg--t">
										<div class="product__function-global">
										<?php $cate = $item->category;
												$string = '';
												foreach($cate as $k => $val){
													if($k!=0){
														$string=$string.', '.$val->name;
													}else{
														$string=$string.$val->name;
													}
												}
											?>
											{{$string}}
										</div>
										<h3 class="product__title-global">
											<a href="{{route('home.single.product',['slug'=>$item->slug])}}" title="{{ $item->name }}">
											{{ $item->name }}
											</a>
										</h3>
										<div class="product__price-global">
											<span class="global__price">
											{{ number_format($item->regular_price,0, '.', '.') }}VND
											</span>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</section>
		@endif
		@if(!empty($content->partner))
		<section class="home__beheshop">
			<div class="container">
				<div class="module module-home__beheshop">
					<div class="module__header header__global" data-aos="fade-up" data-aos-duration="3000">
						<h2 class="title">{{$content->partner->name}}</h2>
						<a href="{{$content->partner->link}}" target="_blank" class="btn btn__follow" title="Theo dõi Instagram">
							Theo dõi Instagram
						</a>
					</div>
					<div class="module__content">
						<div class="beheshop__group">
							@foreach($content->partner->content as $item)
							<div class="beheshop__item" data-aos="fade-up" data-aos-duration="3000">
								<div class="beheshop__box">
									<a href="{{$item->link}}" class="frame" title="{{$item->link}}">
										<img src="{{url('/').$item->image}}" alt="{{$item->link}}"/>
									</a>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</section>
		@endif
	</main>
@endsection