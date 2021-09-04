@extends('frontend.master')
@section('main')
	<main id="main">
		<section class="container">
			<ul class="breadcrumb__global">
				<li>
					<a href="{{route('home.index')}}" title="trang chủ">
					Trang chủ
					</a>
				</li>
				<li>
					<a href="{{route('home.news')}}" title="Tin tức">
					Tin tức
					</a>
				</li>
			</ul>
		</section>
		<section class="detail__new">
			<div class="container">
				<div class="module module-detail__new">
					<div class="module__header">
						<h2 class="title">
							{{$data->name}}
						</h2>
						<ul class="info__tag">
							@foreach($data->category as $item)
							<li>{{$item->name}}</li>
							@endforeach
							@if(!empty($data->minute))
							<li>{{$data->minute}} phút đọc</li>
							@endif
							<li>{{Carbon\Carbon::parse($data->created_at)->translatedFormat('d, M, Y')}}</li>
						</ul>
					</div>
					<div class="module__content">
						<div class="detail__main">
							<div class="detail__main-avata">
								<img src="{{url('/').$data->image_top}}" alt="{{$data->name}}"/>
							</div>
							<div class="detail__main-content">
								<div class="detail__main-share">
									<div class="share__box">
										<h3 class="share__title">Chia sẻ:</h3>
										<ul class="share__group">
											<li>
												<a target="_blank" href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo urlencode($data->name);?>&amp;p[summary]=<?php echo urlencode($data->desc) ?>&amp;p[url]=<?php echo urlencode(url()->current()); ?>&amp;p[images][0]=<?php echo urlencode($data->image); ?>" class="fa fa-facebook" aria-hidden="true"></a>
											</li>
											<li>
												<a href="#" class="fa fa-instagram" aria-hidden="true"></a>
											</li>
											<li>
												<a target="_blank" href="https://twitter.com/share?url={{urlencode(url()->current())}}&text={{$data->title}}" class="fa fa-twitter" aria-hidden="true">
												<img src="" alt=""/>
												</a>
											</li>
										</ul>
									</div>
								</div>
								@if(!empty(@$data->tag))
								<div class="detail__main-desc">
									{!! $data->content !!}
									<div class="detail__main-tage">
										@foreach(json_decode($data->tag) as $item)
										<a href="{{$item->link}}" class="tage__item">
											{{$item->title}}
										</a>
										@endforeach
									</div>
								</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		@if(count($posts_hot))
		<section class="you-should__read">
			<div class="container">
				<div class="module module-you-should__read">
					<div class="module__header">
						<h2 class="title">
							Bạn nên đọc
						</h2>
					</div>
					<div class="module__content">
						<div class="row">
							@foreach($posts_hot as $item)
							<div class="col-12 col-xs-6 col-sm-6 col-md-4">
								<a href="{{route('home.news-single',['slug'=>$item->slug])}}" class="post" title="{{$item->name}}">
									<div class="post__content">
										<h3 class="post__title">
											{{$item->name}}
										</h3>
										<ul class="post__tage">
											@foreach($item->category as $val)
											<li>
												{{$val->name}}
											</li>
											@endforeach
											<li>
											{{ @$item->created_at->diffForHumans() }}
											</li>
										</ul>
									</div>
									<div class="post__avata">
										<div class="frame">
											<img src="{{url('/').$item->image}}" alt="{{$item->name}}">
										</div>
									</div>
								</a>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</section>
		@endif
		@if(count($products_hot))
		<section class="should__user">
			<div class="container">
				<div class="module module-should__user">
					<div class="module__header">
						<h2 class="title">
							Sản phẩm bạn nên dùng
						</h2>
					</div>
					<div class="module__content">
						<div class="row">
							@foreach($products_hot as $item)
							<div class="col-12 col-xs-6 col-sm-6 col-md-3">
								<div class="product__global">
									<div class="product__avata-global">
										<a href="{{route('home.single.product',['slug'=>$item->slug])}}" class="frame" title="Eye Rescue Stick">
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
											{{ number_format($item->regular_price, 0, '.', '.') }}VND
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
	</main>

@endsection