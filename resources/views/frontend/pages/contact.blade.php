@section('css')
<link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/page__contact.css" />
@endsection
@extends('frontend.master')
@section('main')
	<?php 
		if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
		//dd($content);
	} ?>
	<main id="main">
		<section class="page__banner" style="background-image: url('images/slide__1.jpg')">
			<div class="container">
				<div class="header__global">
					<div class="item__global">
						<h1 class="title__global">Liên hệ</h1>
					</div>
					<ul class="breadcrumb">
						<li>
							<a href="index.html" title="Trang chủ"> Trang chủ </a>
						</li>
						<li>
							<a href="page__contact.html" title="Liên hệ"> Liên hệ </a>
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
		<section class="page__contact">
			<div class="container">
				<div class="contact__header">
					<div class="header__logo">
						<img src="{{url('/').@$content->header->image}}" alt="icon__logo-2.png" />
					</div>
					<h2 class="contact__title">{{@$content->header->title}}</h2>
					<div class="contact__share">
						<a href="{{@$content->header->link1}}" target="_bank" title="facebook">
							<img src="{{url('/')}}/public/images/icons/icon__f.png" alt="icon__f.png" />
						</a>
						<a href="{{@$content->header->link2}}" target="_bank" title="instagram">
							<img src="{{url('/')}}/public/images/icons/icon__i.png" alt="i.png" />
						</a>
						<a href="{{@$content->header->link3}}" target="_bank" title="youtube">
							<img src="{{url('/')}}/public/images/icons/icon__y.png" alt="y.png" />
						</a>
					</div>
				</div>
				<div class="contact__body">
					<div class="contact__item">
						<h3 class="contact__name">Liên hệ</h3>
						<a href="https://goo.gl/maps/Z3uytgiAACutmkYZ8" target="_bank" class="contact__addr" title="click xem bản đồ">
							{{@$content->form->address}}
						</a>
						<a href="tel:{{@$content->form->phone}}" target="_bank" class="contact__phone" title="{{@$content->form->phone}}">
							{{@$content->form->phone}}
						</a>
						<a href="maiTo:{{@$content->form->email}}" target="_bank" class="contact__email" title="email">
							{{@$content->form->email}}
						</a>

						<form class="contact__form" action="{{route('home.post-contact')}}">
							@csrf
							<div>
								<input type="text" placeholder="Họ và tên *" name="name" />
								<span class="fr-error fr-error_name"></span>
							</div>
							<div>
								<input type="text" placeholder="Số điện thoại*" name="phone" />
								<span class="fr-error fr-error_phone"></span>
							</div>
							<div>
								<input type="text" placeholder="Địa chỉ" name="address" />
								<span class="fr-error fr-error_address"></span>
							</div>
							<div>
								<input type="email" placeholder="Email" name="email" />
								<span class="fr-error fr-error_email"></span>
							</div>
							<textarea placeholder="Ghi chú" name="content"></textarea>
							<span class="fr-error fr-error_content"></span>
							<button class="btn btn__send btn__send__contact">Gửi</button>
						</form>
					</div>
					<div class="contact__item">
						{!! @$content->code_google_map !!}
					</div>
				</div>
			</div>
		</section>
	</main>
	@section('script')
		<script>
			$('.btn__send__contact:not(".disabled")').click(function(e){

				e.preventDefault();

				$('.loadingcover').show();

				const el = $(this);

				const UrlContact =el.parents('form').attr('action');

				const data = el.parents('form').serialize();

				el.addClass('disabled');

				$('.fr-error').html('');

				$.ajax({

					type: 'POST',

					url: UrlContact,

					dataType: "json",

					data: data,

					success:function(data){

						el.removeClass('disabled');

						if(data.success==false)
						{
							if(data.errorMessage){

								$.each(data.errorMessage, function(field, item) {
	
									$('.fr-error_'+field).html(item);
									
								});
							}else{
								toastr["error"](data.message, "Thông báo");
							}
						}

						if (data.success==true) {

							toastr["success"](data.message, "Thông báo");
							
							el.parents('form')[0].reset();

						}

						$('.loadingcover').hide();

					},error:function(){
						$('.loadingcover').hide();
					}

				});

				});
		</script>
	@endsection
@endsection