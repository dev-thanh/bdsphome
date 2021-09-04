<?php 
	$curent_page = request()->get('page') ? request()->get('page') : '1';
	if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	}
 ?>
@extends('frontend.master')
@section('main')
	<main id="main">
		<div class="container">
			<ul class="breadcrumb__global">
				<li>
					<a href="index.html" title="trang chủ">
					Trang chủ
					</a>
				</li>
				<li>
					<a href="page__new.html" title="Skincare">
					Tin tức</a>
				</li>
			</ul>
		</div>
		<div class="page__new">
			<div class="module module-page__new">
				<div class="module__header">
					<div class="container">
						{!! @$content->header !!}
					</div>
				</div>
				<div class="module__content">
					<div class="container">
						<div class="bs-tab">
							<div class="tab-container">
								<div class="tab-control">
									<ul class="control-list" data-aos="fade-up" data-aos-duration="3000">
										<li class="control-list__item active" tab-show="#tab">Tất cả</li>
										@foreach($cate_post as $k =>$item)
										<li class="control-list__item" tab-show="#tab{{$k+1}}">{{$item->name}}</li>
										@endforeach
									</ul>
								</div>
								<div class="tab-content">
									<div class="tab-item active" id="tab">
										<div class="row">
											@foreach($posts as $item)
											<div class="col-12 col-xs-6 col-sm-6 col-md-4" data-aos="fade-up" data-aos-duration="3000">
												<div class="new__global">
													<div class="new__global-avata">
														<a href="{{route('home.news-single',['slug'=>$item->slug])}}" class="frame" title="{{$item->name}}">
														<img src="{{url('/').$item->image}}" alt="{{$item->name}}">
														</a>
													</div>
													<div class="new__global-content">
														<h3 class="new__global-title">
															<a href="{{route('home.news-single',['slug'=>$item->slug])}}" title="{{$item->name}}">
															{{$item->name}}
															</a>
														</h3>
														<ul class="new__global-tag">
															<li>
																@foreach($item->category as $value)
																<span>
																	{{$value->name}}
																</span>
																@endforeach
															</li>
															@if(!empty($item->minute))
															<li>
																<span>
																{{$item->minute}} PHÚT ĐỌC
																</span>
															</li>
															@endif
														</ul>
														<div class="new__global-desc">
															<p>
																{{$item->desc}}
															</p>
														</div>
													</div>
												</div>
											</div>
											@endforeach
										</div>
									</div>
									@foreach($cate_post as $k =>$item)
									<div class="tab-item" id="tab{{$k+1}}">
										<div class="row">
											@foreach($item->Posts as $val)
											<div class="col-12 col-xs-6 col-sm-6 col-md-4" data-aos="fade-up" data-aos-duration="3000">
												<div class="new__global">
													<div class="new__global-avata">
														<a href="{{route('home.news-single',['slug'=>$item->slug])}}" class="frame" title="{{$val->name}}">
														<img src="{{url('/').$val->image}}" alt="{{$val->name}}">
														</a>
													</div>
													<div class="new__global-content">
														<h3 class="new__global-title">
															<a href="{{route('home.news-single',['slug'=>$item->slug])}}" title="{{$val->name}}">
															{{$val->name}}
															</a>
														</h3>
														<ul class="new__global-tag">
															<li>
																<span>
																	{{$item->name}}
																</span>
															</li>
															<li>
																<span>
																2 PHÚT ĐỌC
																</span>
															</li>
														</ul>
														<div class="new__global-desc">
															<p>
																{{$val->desc}}
															</p>
														</div>
													</div>
												</div>
											</div>
											@endforeach
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	@section('script')
	<script>

        jQuery(document).ready(function($) {

            $('[data-page="{{$curent_page}}"]').addClass('active');

        });

    </script>
    @endsection
@endsection