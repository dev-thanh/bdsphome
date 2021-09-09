@section('css')
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0&appId=1472426692944496&autoLogAppEvents=1" nonce="cRcsDDJ3"></script>
	<link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/detail__news.css" />
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/cm__new.css" />
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
		<section class="page__banner" style="background-image: url('images/slide__1.jpg')">
			<div class="container">
				<div class="header__global">
					<div class="item__global">
						<h1 class="title__global">Tin tức</h1>
					</div>
					<ul class="breadcrumb">
						<li>
							<a href="{{route('home.index')}}" title="Trang chủ">
								Trang chủ
							</a>
						</li>
						<li>
							<a href="{{route('home.news')}}" title="Tin tức">
								Tin tức
							</a>
						</li>
						<li>
							<a title="Tin tức">
								{{$data->name}}
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
		<section class="detail__new">
			<div class="container">
				<div class="detail">
					<h1 class="detail__title">
						{{$data->name}}
					</h1>
					<div class="detail__time">
						<time class="item">
							Ngày đăng: {{format_datetime($data->created_at,'d/m/Y')}}
						</time>
					</div>
					<div class="detail__share">
						<a href="#" class="share__item">
							<img src="{{url('/')}}/public/images/icons/share__1.png" alt="share__1.png" />
						</a>
						<a href="#" class="share__item">
							<img src="{{url('/')}}/public/images/icons/share__2.png" alt="share__2.png" />
						</a>
						<a href="#" class="share__item">
							<img src="{{url('/')}}/public/images/icons/share__3.png" alt="share__3.png" />
						</a>
					</div>
					<div class="detail__desc">
						{!! $data->content !!}
						<div class="facebook__comment">
							<div class="fb-box">
								<div class="fb-comments" data-href="{{url()->current()}}#services" data-width="100%" data-numposts="3"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		@if(count($new_same_category))
		<section class="new__same">
			<div class="container">
				<div class="header__global">
					<div class="item__global">
						<h2 class="title__global">
							Bài viết tương tự
						</h2>
					</div>
				</div>
				<div class="module__content">
					<div class="same__slide">
						@foreach($new_same_category as $item)
						<div class="same__item">
							<div class="same__box">
								<a href="{{route('home.news-single',['slug'=>$item->slug])}}" class="frame">
									<img src="{{url('/').$item->image}}" alt="{{$item->name}}" />
								</a>
								<div class="same__content">
									<time class="same__time">
										{{format_datetime($item->created_at,'d/m/Y')}}
									</time>
									<h3 class="same__title">
										<a href="{{route('home.news-single',['slug'=>$item->slug])}}" title="{{$item->name}}">
											{{$item->name}}
										</a>
									</h3>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</section>
		@endif
	</main>
@endsection
@section('script')
	<script>
		$(document).ready(function() {
			sameNews = () => {
				$(".same__slide").slick({
					dots: false,
					slidesToShow: 4,
					slidesToScroll: 4,
					arrows: false,
					autoplay: true,
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
			sameNews();
		});
	</script>
@endsection