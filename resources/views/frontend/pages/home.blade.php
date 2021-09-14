@section('css')
	<link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/index.css" />
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/cm__product.css" />
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/cm__new.css" />
@endsection
@extends('frontend.master')
@section('main')

	<?php if(!empty($contentHome)){
		$content = json_decode($contentHome->content);
	} ?>
	
	<main id="main">
		<section class="home-banner">
			@foreach($slider as $item)
			<div class="banner__item">
				<div class="banner__box">
					<div class="frame">
						<img src="{{url('/').$item->image}}" alt="{{$item->title}}" />
					</div>
				</div>
			</div>
			@endforeach
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
													<img src="https://tpl.gco.vn/bds/images/icons/icon__search.png" alt="icon__search.png" />
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
										<div class="form__item action active">
											<button type="button" class="btn btn__click">
												Thu gọn
											</button>
											<button type="reset" class="btn btn__reset">
												<img src="https://tpl.gco.vn/bds/images/icons/icon__reset.png" alt="icon__reset.png" />
											</button>
										</div>
									</div>
									<div class="form__footer ">
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
													<img src="https://tpl.gco.vn/bds/images/icons/icon__search.png" alt="icon__search.png" />
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
													<img src="https://tpl.gco.vn/bds/images/icons/icon__search.png" alt="icon__search.png" />
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
		<section class="home-product">
			<div class="container">
				<div class="header__global">
					<div class="item__global">
						<h1 class="title__global">Bất động sản</h1>
					</div>
					<div class="item__global">
						<a href="page__realEstate.html" class="btn btn__global" title="Xem tất cả">
							Xem tất cả
						</a>
					</div>
				</div>
				<div class="module__content">
					<div class="slide__product">
						@foreach($bds as $item)
						<div class="slide__item">
							<div class="slide__box">
								<div class="product__global">
									<a href="{{route('home.single-bds',['slug'=>$item->slug])}}" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang">
										<div class="frame">
											<img src="https://tpl.gco.vn/bds/images/product__1.jpg" alt="product__1.jpg" />
										</div>
										<span class="price__global">
											2.15 Tỷ
										</span>
									</a>
									<div class="content__global">
										<a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps">
											Quận Tân Bình, TP. Hồ Chí Minh
										</a>
										<h3 class="title__global">
											<a href="{{route('home.single-bds',['slug'=>$item->slug])}}" title="{{$item->title}}">
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
											<!-- <span class="tags__item">
												Đã có sổ
											</span> -->
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
		<section class="home-bsd">
			<div class="container">
				<div class="header__global">
					<div class="item__global">
						<h2 class="title__global">Bất động sản theo khu vực</h2>
					</div>
				</div>
				<div class="module__content">
					<div class="bsd__group">
						<a href="#" class="bsd__item" title="">
							<div class="frame">
								<img src="https://tpl.gco.vn/bds/images/bsd__1.png" alt="bsd__1.png" />
							</div>
							<div class="bsd__content">
								<h3 class="bsd__address">Hà nội</h3>
								<span class="bsd__total">
									246 tin
								</span>
							</div>
						</a>
						<a href="#" class="bsd__item" title="">
							<div class="frame">
								<img src="https://tpl.gco.vn/bds/images/bsd__1.png" alt="bsd__1.png" />
							</div>
							<div class="bsd__content">
								<h3 class="bsd__address">Hà nội</h3>
								<span class="bsd__total">
									246 tin
								</span>
							</div>
						</a>
						<a href="#" class="bsd__item" title="">
							<div class="frame">
								<img src="https://tpl.gco.vn/bds/images/bsd__1.png" alt="bsd__1.png" />
							</div>
							<div class="bsd__content">
								<h3 class="bsd__address">Hà nội</h3>
								<span class="bsd__total">
									246 tin
								</span>
							</div>
						</a>
						<a href="#" class="bsd__item" title="">
							<div class="frame">
								<img src="https://tpl.gco.vn/bds/images/bsd__1.png" alt="bsd__1.png" />
							</div>
							<div class="bsd__content">
								<h3 class="bsd__address">Hà nội</h3>
								<span class="bsd__total">
									246 tin
								</span>
							</div>
						</a>
						<a href="#" class="bsd__item" title="">
							<div class="frame">
								<img src="https://tpl.gco.vn/bds/images/bsd__1.png" alt="bsd__1.png" />
							</div>
							<div class="bsd__content">
								<h3 class="bsd__address">Hà nội</h3>
								<span class="bsd__total">
									246 tin
								</span>
							</div>
						</a>
					</div>
				</div>
			</div>
		</section>
		<section class="home-about" style="background-image: url('{{url('/').@$content->home->background}}')">
			<div class="container">
				<div class="header__global">
					<div class="item__global">
						<h2 class="title__global">{{@$content->home->title}}</h2>
						<div class="about__desc">
							{!! @$content->home->content !!}
						</div>
					</div>

					<div class="item__global">
						<a href="{{route('home.about')}}" class="btn btn__global" title="Xem chi tiết">
							Xem chi tiết
						</a>
					</div>
				</div>
				<div class="module__content">
					<div class="about__group">
						<div class="about__item">
							<img src="{{url('/').@$content->home->logo}}" alt="icon__logo.png" />
						</div>
						<div class="about__item">
							<h3 class="about__number">700</h3>
							<div class="about__note">Sản phẩm đã được bán</div>
						</div>
						<div class="about__item">
							<h3 class="about__number">120+</h3>
							<div class="about__note">Dự án đã hoàn thành</div>
						</div>
						<div class="about__item">
							<h3 class="about__number">3</h3>
							<div class="about__note">Văn phòng đại diện</div>
						</div>
						<div class="about__item">
							<h3 class="about__number">100+</h3>
							<div class="about__note">Đội ngũ nhân viên</div>
						</div>
					</div>
				</div>
			</div>
			<div class="banner__right">
				<img src="{{url('/').@$content->home->image}}" alt="banner__right.png" />
			</div>
		</section>
		@if(!empty($cateServices))
		<section class="home-service">
			<div class="container">
				<div class="header__global">
					<div class="item__global">
						<h2 class="title__global">Dịch vụ</h2>
					</div>
				</div>
				<div class="module__content">
					<div class="service__group">
						@foreach($cateServices as $item)
						<div class="service__item">
							<div class="service__icon">
								<img src="{{url('/').$item->banner}}" alt="{{$item->name}}" />
							</div>
							<div class="service__content">
								<h3 class="service__title">
									<a href="#" title="">
										{{$item->name}}
									</a>
								</h3>
								<div class="service__desc">
									{!! $item->content !!}
								</div>
								<a href="#" class="btn btn__global" title="Chi tiết">
									Chi tiết
								</a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</section>
		@endif
		<section class="home__project">
			<div class="container">
				<div class="header__global">
					<div class="item__global">
						<h2 class="title__global">Dự án nổi bật</h2>
					</div>
					<div class="item__global">
						<a href="#" class="btn btn__global" title="Xem tất cả">
							Xem tất cả
						</a>
					</div>
				</div>
			</div>

			<div class="module__content">
				<div class="project__group" style="background-image: url('{{url('/').@$content->hot->background}}')">
				@foreach($projectsHot as $item)
					<a href="#" class="project__item" title="Aqua City">
						<div class="project__content">
							<div class="project__address">
								{{$item->address}}
							</div>
							<h3 class="project__title">{{$item->name}}</h3>
						</div>
					</a>
					@endforeach
				</div>
			</div>
		</section>
		<section class="home-news">
			<div class="container">
				<div class="header__global">
					<div class="item__global">
						<h2 class="title__global">Tin tức</h2>
					</div>
					<div class="item__global">
						<a href="{{route('home.news')}}" class="btn btn__global" title="Xem tất cả">
							Xem tất cả
						</a>
					</div>
				</div>
				<div class="module__content">
					<div class="new__slide">
						@foreach($posts as $item)
						<div class="slide__item">
							<div class="new">
								<a href="{{route('home.news-single',['slug'=>$item->slug])}}" class="frame">
									<img src="{{url('/').$item->image}}" alt="{{$item->name}}" />
								</a>
								<div class="new__content">
									<time class="new__time">
										{{format_datetime($item->created_at,'d/m/Y')}}
									</time>
									<h3 class="new__title">
										<a href="{{route('home.news-single',['slug'=>$item->slug])}}" title="Top 5 kinh nghiệm đầu tư bất động sản siêu hay không nên bỏ lỡ">
											{{$item->name}}
										</a>
									</h3>
									<div class="new__desc">
										{{$item->desc}}
									</div>
									<a href="{{route('home.news-single',['slug'=>$item->slug])}}" class="btn btn__global" title="Chi tiết">
										Chi tiết
									</a>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</section>
		@if(@$content->logo)
		<section class="partner">
			<div class="container">
				<div class="partner__slide">
					@foreach(@$content->logo->content as $item)
					<div class="partner__item">
						<div class="partner__box">
							<a href="{{@$item->link}}" class="frame">
								<img src="{{url('/').$item->image}}" alt="{{@$item->title}}" />
							</a>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</section>
		@endif
	</main>
@endsection
@section('script')
<script>
	$(document).ready(function() {
		homeBanner = () => {
			$(".home-banner").slick({
				dost: false,
				arrows: true,
				autoplay: true
			});
		};
		homeBanner();
		homeProduct = () => {
			$(".slide__product").slick({
				dots: false,
				slidesToShow: 4,
				rows: 2,
				slidesToScroll: 4,
				responsive: [{
					breakpoint: 991.98,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3
					}
				}, {
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				}, {
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}, ]
			});
		};
		homeProduct();
		homeNew = () => {
			$(".new__slide").slick({
				dots: false,
				autoplay: true
			});
		};
		homeNew();
		homeParter = () => {
			$(".partner__slide").slick({
				dots: false,
				arrows: false,
				slidesToShow: 5,
				slidesToScroll: 1,
				autoplay: true,
				responsive: [{
					breakpoint: 991.98,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 1
					}
				}, {
					breakpoint: 600,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 2
					}
				}, {
					breakpoint: 479.98,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				}, ]
			});
		};
		homeParter();
	});
</script>
@stop