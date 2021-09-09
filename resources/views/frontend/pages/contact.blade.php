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
						<img src="images/icons/icon__logo-2.png" alt="icon__logo-2.png" />
					</div>
					<h2 class="contact__title">Công ty Cổ phần D LAND</h2>
					<div class="contact__share">
						<a href="https://www.facebook.com/" target="_bank" title="facebook">
							<img src="images/icons/icon__f.png" alt="icon__f.png" />
						</a>
						<a href="https://www.instagram.com/" target="_bank" title="instagram">
							<img src="images/icons/icon__i.png" alt="i.png" />
						</a>
						<a href="https://www.youtube.com/" target="_bank" title="youtube">
							<img src="images/icons/icon__y.png" alt="y.png" />
						</a>
					</div>
				</div>
				<div class="contact__body">
					<div class="contact__item">
						<h3 class="contact__name">Liên hệ</h3>
						<a href="https://goo.gl/maps/Z3uytgiAACutmkYZ8" target="_bank" class="contact__addr" title="click xem bản đồ">
							162 Võ Nguyên Giáp, Ngũ Hành Sơn, Đà Nẵng
						</a>
						<a href="tel:+(84) 36 956 0246" target="_bank" class="contact__phone" title="số điện thoại">
							+(84) 36 956 0246
						</a>
						<a href="maiTo:info@dland.vn" target="_bank" class="contact__email" title="email">
							info@dland.vn
						</a>

						<form class="contact__form">
							<input type="text" placeholder="Họ và tên *" />
							<input type="text" placeholder="Số điện thoại*" />
							<input type="text" placeholder="Địa chỉ" />
							<input type="email" placeholder="Email" />
							<textarea placeholder="Ghi chú"></textarea>
							<button class="btn btn__send">Gửi</button>
						</form>
					</div>
					<div class="contact__item">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.824448252617!2d108.24244441460944!3d16.07459708887758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142178f470c24ad%3A0x288b1c7477f844fa!2zMTYyIFbDtSBOZ3V5w6puIEdpw6FwLCBQaMaw4bubYyBN4bu5LCBTxqFuIFRyw6AsIMSQw6AgTuG6tW5nIDU1MDAwMCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1627660739528!5m2!1svi!2s" width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"></iframe>
					</div>
				</div>
			</div>
		</section>
	</main>

@endsection