@extends('frontend.master')
@section('main')

	<?php 
		if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	} ?>

	<main id="main">
		<div class="container">
			<ul class="breadcrumb__global">
				<li>
					<a href="{{route('home.index')}}" title="trang chủ">
					Trang chủ
					</a>
				</li>
				<li>
					<a href="page__product.html" title="Skincare">
					Skincare
					</a>
				</li>
				<li>
					<a href="" title="Skincare">{{$data->name}}</a>
				</li>
			</ul>
		</div>
		<div class="detail__product">
			<div class="container">
				<div class="module module-detail__product">
					<div class="module__content">
						<div class="detail__header">
							<form action="{{ route('home.post-add-cart') }}" method="POST">
								<div class="detail__header-item">
									@csrf
									<span class="detail__tag">
									FACE, MOISTURISER
									</span>
									<h2 class="detail__title">{{$data->name}}</h2>
									<div class="detail__parameter">
										<div class="parameter__item">
											<span class="detail__price">
												{{ number_format($data->regular_price,0, '.', '.') }}VND
											</span>
											<span class="detail__ml">
												{{$data->volume}}
											</span>
										</div>
										<div class="parameter__item">
											<span class="detail__sale">
											Giảm {{$data->sale_price}}%
											</span>
										</div>
									</div>
									<div class="detail__desc" id="view__desc">
										<div class="desc">
											{!! $data->sort_desc !!}
										</div>
									</div>
									<?php $cd = json_decode($data->cd_content); ?>
									@if(!empty($cd))
									<ul class="detail__list">
										@foreach($cd as $item)
										<li class="detail__list-item">
											{{$item->title}}
										</li>
										@endforeach
									</ul>
									@endif
									<div class="detail__selected">
									<?php $color = json_decode($data->color_content); ?>
									@if(!empty($color))
									<div class="detail__slected-title">Màu</div>
										@foreach($color as $k => $item)
										<label for="color__{{$k+1}}" class="selected__color" style="background-color: {{$item->value}}">
										<input type="checkbox" id="color__{{$k+1}}" name="color" value="{{$item->value}}" class="chekbox" @if ($loop->first) checked="checked" @endif />
										<span class="bg__color"></span>
										</label>
										@endforeach
									</div>
									@endif
									<button href="page__cart.html" class=" btn btn__add-cart" type="submit">
										Thêm vào giỏ hàng
									</button>
									<input type="hidden" name="id_product" value="{{ $data->id }}">
	                            	<input type="hidden" id="id_price" name="price" value="{{ @$data->regular_price }}">
	                            	<input type="hidden"  name="sale_price" value="{{ @$data->sale_price }}">
	                            	<input type="hidden" name="volume" value="{{ @$data->volume }}">
								</div>
							</form>
							<?php $more_image = json_decode($data->more_image); ?>
							@if(!empty($more_image))
							<div class="detail__header-item">
								<div class="product__slide">
									@foreach($more_image as $item)
									<div class="product__item">
										<div class="box">
											<div class="frame">
												<img src="{{url('/').$item}}" alt="{{$data->name}}"/>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
							@endif
						</div>
						<div class="detail__main">
							<h3 class="detail__title">Chi tiết sản phẩm</h3>
							<div class="detail__main-content">
								<!-- <h4 class="detail__main-title">Thông tin</h4> -->
								<div class="detail__main-desc">
									{!! $data->content !!}
								</div>
								<h4 class="detail__main-title">Công dụng</h4>
								@if(!empty($cd))
								<ul class="detail__main--list">
									@foreach($cd as $item)
									<li>
										{{$item->title}}
									</li>
									@endforeach
								</ul>
								@endif
							</div>
						</div>
						@if($product_combined!='')
						<div class="combined__products">
							<h2 class="combined__title">Sản phẩm kết hợp</h2>
							<div class="row">
								@foreach($product_combined as $item)
								<div class="col-12 col-xs-6 col-sm-6 col-md-3">
									<div class="product__global">
										<div class="product__avata-global">
											<a href="{{route('home.single.product',['slug'=>$item->slug])}}" class="frame" title="{{$item->name}}">
											<img class="img__global" src="{{url('/').$item->image}}" alt="{{$item->name}}"/>
											<img class="img__hover-global" src="{{url('/').$item->image_hover}}" alt="{{$item->name}}"/>
											</a>
										</div>
										<div class="product__content-global">
											<div class="product__function-global">
												FACE, BODY
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
						@endif
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection