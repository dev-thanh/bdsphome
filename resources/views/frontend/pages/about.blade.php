@section('css')
	<link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/page__aboutUs.css" />
@endsection
@extends('frontend.master')
@section('main')
	<?php 
		if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
		//dd($content);
	} ?>

	<main id="main">
		<section class="page__aboutUs">
			<div class="container">
				<div class="about__header">
					<div class="about__item">
						<div class="about__box">
							<div class="about__content">
								<h1 class="title__global">
									{{@$content->introduce->title}}
								</h1>
								<div class="about__desc">
									{!! @$content->introduce->content !!}
								</div>
								<a href="page__realEstate.html" class="btn btn__global" title="Xem tất cả bất động sản">
									Xem tất cả bất động sản
								</a>
							</div>
							<div class="about__group">
								@if(!empty(@$content->statistical))
									@foreach(@$content->statistical->content as $item)
									<div class="item">
										<h3 class="item__title">
											{{$item->title1}}
										</h3>
										<p class="item__info">
											{{$item->title2}}
										</p>
									</div>
									@endforeach
								@endif
							</div>
						</div>
						<div class="par__group">
							@if(!empty(@$content->logo))
								@foreach(@$content->logo->content as $logo)
								<div class="par__item">
									<img src="{{url('/').$logo->image}}" alt="{{$logo->title}}">
								</div>
								@endforeach
							@endif
						</div>
					</div>
					<div class="about__item">
						<div class="frame">
							<img src="{{url('/').@$content->introduce->image}}" alt="{{@$content->introduce->title}}">
						</div>
					</div>
				</div>

			</div>
			@if(!empty($content->noidungbaihoc))
			<div class="about__body" style="background-image: url('{{url('/').@$dataSeo->banner}}');">
				<div class="container">
					<div class="about__body-group">
						@foreach($content->noidungbaihoc->content as $item)
						<div class="about__body-item">
							<div class="about__body-avatar">
								<div class="frame">
									<img src="{{url('/').@$item->image}}" alt="{{@$item->title}}">
								</div>
							</div>
							<div class="about__body-content">
								<h2 class="about__body-title">
									{{@$item->title}}
								</h2>
								<div class="about__body-desc">
									{!! @$item->desc !!}
								</div>

							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			@endif
			@if(!empty($content->core_value))
			<div class="core__values">
				<div class="container">
					<div class="header__global">
						<div class="item__global">
							<h2 class="title__global text__center">
								{{@$content->core_value->title}}
							</h2>
						</div>

					</div>
					<div class="module__content">
						<div class="core__values-group">
							@foreach($content->core_value->content as $core)
							<div class="core__values-item">
								<div class="core__values-avatar">
									<img src="{{url('/').$core->image}}" alt="{{$core->title}}">
								</div>
								<div class="core__values-content">
									<h3 class="core__values-title">
										{{$core->title}}
									</h3>
									<div class="core__values-desc">
										{{$core->desc}}
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
			@endif
		</section>
	</main>
@endsection