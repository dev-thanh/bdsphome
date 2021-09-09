<?php 
	$curent_page = request()->get('page') ? request()->get('page') : '1';
	if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	}
 ?>
@section('css')
<link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/page__news.css" />
<link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/cm__new.css" />
@endsection
@extends('frontend.master')
@section('main')
	<main id="main">
		<section class="page__banner" style="background-image:url('{{url('/').$dataSeo->banner}}')">
			<div class="container">
				<div class="header__global">
					<div class="item__global">
						<h1 class="title__global">{{$dataSeo->meta_title}}</h1>
					</div>
					<ul class="breadcrumb">
						<li>
							<a href="{{route('home.index')}}" title="Trang chủ">
								Trang chủ
							</a>

						</li>
						<li>
							<a href="{{route('home.news')}}" title="{{$dataSeo->meta_title}}">
								{{$dataSeo->meta_title}}
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
								<li class="control-list__item " tab-show="#real-estate">
									Bất động sản
								</li>
								<li class="control-list__item " tab-show="#project">
									Dự án
								</li>
								<li class="control-list__item active" tab-show="#news">
									Tin tức
								</li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-item " id="real-estate">
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
							<div class="tab-item active" id="news">
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
		<section class="page__news">
			<div class="container">
				<div class="bs-tab">
					<div class="tab-container">
						<div class="tab-control">
							<ul class="control-list">
								<li class="control-list__item active" tab-show="#all">Tất cả</li>
								@foreach($cate_post as $k =>$item)
								<li class="control-list__item" tab-show="#tab{{$k+1}}">{{$item->name}}</li>
								@endforeach
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-item id-category-news active" id="all" data-cate="all">
								<div class="tab__new page__news-group">
									@foreach($posts as $item)
									<div class="new">
										<a href="{{route('home.services-single',['slug'=>$item->slug])}}" class="frame">
											<img src="{{url('/').$item->image}}" alt="{{$item->name}}" />
										</a>
										<div class="new__content">
											<time class="new__time">
												{{format_datetime($item->created_at,'d/m/Y')}}
											</time>
											<h3 class="new__title">
												<a href="{{route('home.services-single',['slug'=>$item->slug])}}" title="{{$item->name}}">
													{{$item->name}}
												</a>
											</h3>
											<div class="new__desc">
												{!! $item->desc !!}
											</div>
											<a href="{{route('home.services-single',['slug'=>$item->slug])}}" class="btn btn__global" title="Chi tiết">
												Chi tiết
											</a>
										</div>
									</div>
									@endforeach
								</div>
                                @if($posts->lastpage() > 1)
                                <nav>
                                    <ul class="addon__pagination pagination">
                                        <li class="addon__pagination-item prev-page">
                                            <a href="" class="addon__pagination-item-link">
                                                <img src="{{url('/').'/public/images/icons/icon__prev.png'}}" alt="icon__next.png">
                                            </a>
                                        </li>
                                        @for($i=1;$i<=$posts->lastpage();$i++)
                                        <li class="addon__pagination-item page-item li-item @if($i==1) active @endif">
                                            <a href="" class="addon__pagination-item-link" data-page="{{$i}}">{{$i}}</a>
                                        </li>
                                        @endfor
                                        <li class="addon__pagination-item next-page" data-lastpage="{{$posts->lastpage()}}">
                                            <a href="" class="addon__pagination-item-link addon__next">
                                                <img src="{{url('/').'/public/images/icons/icon__next.png'}}" alt="icon__next.png">
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                                @endif
							</div>
							@foreach($cate_post as $k =>$value)
							<div class="tab-item id-category-news" id="tab{{$k+1}}" data-cate="{{$value->id}}">
								<div class="tab__new page__news-group">
									@if(!empty($value->Posts))
										<?php $news = $value->Services()->paginate(10); ?>
										@foreach($news as $val)
										<div class="new">
											<a href="{{route('home.services-single',['slug'=>$val->slug])}}" class="frame">
												<img src="{{url('/').$val->image}}" alt="{{$val->name}}" />
											</a>
											<div class="new__content">
												<time class="new__time">
													{{format_datetime($val->created_at,'d/m/Y')}}
												</time>
												<h3 class="new__title">
													<a href="{{route('home.services-single',['slug'=>$val->slug])}}" title="{{$val->name}}">
														{{$val->name}}
													</a>
												</h3>
												<div class="new__desc">
													{!! $val->desc !!}
												</div>
												<a href="{{route('home.services-single',['slug'=>$val->slug])}}" class="btn btn__global" title="Chi tiết">
													Chi tiết
												</a>
											</div>
										</div>
										@endforeach
										@endif
								</div>
                                @if($news->lastpage() > 1)
								<nav>
									<ul class="addon__pagination pagination">
										<li class="addon__pagination-item prev-page">
											<a href="" class="addon__pagination-item-link">
												<img src="{{url('/').'/public/images/icons/icon__prev.png'}}" alt="icon__next.png">
											</a>
										</li>
										@for($i=1;$i<=$news->lastpage();$i++)
										<li class="addon__pagination-item page-item li-item @if($i==1) active @endif">
											<a href="" class="addon__pagination-item-link" data-page="{{$i}}">{{$i}}</a>
										</li>
										@endfor
										<li class="addon__pagination-item next-page" data-lastpage="{{$news->lastpage()}}">
											<a href="" class="addon__pagination-item-link addon__next">
												<img src="{{url('/').'/public/images/icons/icon__next.png'}}" alt="icon__next.png">
											</a>
										</li>
									</ul>
								</nav>
                                @endif
							</div>
							@endforeach
						</div>
					</div>
				</div>

			</div>
		</section>
	</main>
	@section('script')
	<script>

        jQuery(document).ready(function($) {

			const loading = '<div class="loadingcover">'+
                '<p class="csslder">'+
                    '<span class="csswrap">'+
                        '<span class="cssdot"></span>'+
                        '<span class="cssdot"></span>'+
                        '<span class="cssdot"></span>'+
                    '</span>'+
                '</p>'+
            '</div>';

            $('[data-page="{{$curent_page}}"]').addClass('active');

			$(document).on('click','ul.pagination .li-item:not(".active,.next-page,.prev-page") a',function(e) {
	        	e.preventDefault();

	        	const _this = $(this);

	        	const curent_page = $(this).data('page');

	        	$(this).parents('.pagination').find('.active').removeClass('active');

	        	$(this).parents('.page-item').addClass('active');

	        	const next_page = parseFloat(curent_page);

	        	const cate = $(this).parents('.id-category-news').data('cate');

	        	$(this).parents('.id-category-news').find('.page__news-group').append(loading);

	        	const url_web = '{{url('/')}}';

	        	$.ajax({

		            url: '{{route('home.ajax-load-services')}}?page='+next_page,

		            type: 'GET',

		            cache: false,

		            data: {"cate":cate},

		            success: function(data){

		            	if(data.status =='success'){

		            		_this.parents('.id-category-news').find('.page__news-group').html(data.html_response);

		            	}

		                if(data.status =='error'){
		                	_this.parents('.projec__view').find('.icon-ajax-load-more').remove();
		                }
		            }
		        });
	        });

	        $(document).on('click','.next-page',function(e) {
                e.preventDefault();

	        	const page = $(this).parents('nav').find('li.active a').data('page');

	        	const last_page = $(this).data('lastpage');

	        	if(page == last_page){
	        		return false;
	        	}

	        	const _this = $(this);

	        	const next_page = parseFloat(page)+1;

	        	const cate = $(this).parents('.id-category-news').data('cate');

	        	$(this).parents('.pagination').find('.active').removeClass('active');

	        	$(this).parents('.pagination').find('a[data-page="'+next_page+'"]').parents('li').addClass('active');

	        	$(this).parents('.id-category-news').find('.page__news-group').append(loading);

	        	$.ajax({

		            url: '{{route('home.ajax-load-services')}}?page='+next_page,

		            type: 'GET',

		            cache: false,

		            data: {"cate":cate},

		            success: function(data){

		            	if(data.status =='success'){

		            		_this.parents('.id-category-news').find('.page__news-group').html(data.html_response);

		            	}

		                if(data.status =='error'){
		                	_this.parents('.projec__view').find('.icon-ajax-load-more').remove();
		                }
		            }
		        });

	        });

	        $(document).on('click','.prev-page',function(e) {
                e.preventDefault();

	        	var page = $(this).parents('nav').find('li.active a').data('page');

	        	var last_page = $(this).data('lastpage');

	        	if(page < 2){
	        		return false;
	        	}

	        	var _this = $(this);

	        	var prev_page = parseFloat(page)-1;

	        	var cate = $(this).parents('.id-category-news').data('cate');

	        	$(this).parents('.pagination').find('.active').removeClass('active');

	        	$(this).parents('.pagination').find('a[data-page="'+prev_page+'"]').parents('li').addClass('active');

	        	$(this).parents('.id-category-news').find('.page__news-group').append(loading);

	        	$.ajax({

		            url: '{{route('home.ajax-load-services')}}?page='+prev_page,

		            type: 'GET',

		            cache: false,

		            data: {"cate":cate},

		            success: function(data){

		            	if(data.status =='success'){

		            		_this.parents('.id-category-news').find('.page__news-group').html(data.html_response);

		            	}

		                if(data.status =='error'){
		                	_this.parents('.projec__view').find('.icon-ajax-load-more').remove();
		                }
		            }
		        });

	        });

        });

    </script>
    @endsection
@endsection