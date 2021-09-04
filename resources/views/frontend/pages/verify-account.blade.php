<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>	Mã xác thực
</title>
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/tool.min.css" />
<!-- <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/reset.css" /> -->
<link rel="stylesheet" href="{{ __BASE_URL__ }}/css/main.min.css" />
  </head>

<body>
    <header id="header">
	<div class="container">
		<div class="header__top">
			<h1 class="logo">
				<a href="index.html" class="logo__link" title="beheshop">
					<img src="{{ __BASE_URL__ }}/images/icons/icon__logo.png" alt="icon__logo.png"/>
				</a>
			</h1>
			<div class="header__control">
				<div class="header__control-item header__search">
					<a href="page__search.html" class="search">

						<img src="{{ __BASE_URL__ }}/images/icons/icon__search.svg" alt="icon__search.svg"/>

					</a>
				</div>

				<div class="header__control-item header__auth">
					<button class="btn" type="button" modal-show="show" modal-data="#auThModal">
						<img src="{{ __BASE_URL__ }}/images/icons/icons__user.svg" alt="icons__user.svg"/>
					</button>
				</div>
				<div class="header__control-item header__cart">
					<button class="btn header__cart-link" title="Giỏ hàng" type="button" modal-show="show" modal-data="#cartModal">
						<img src="{{ __BASE_URL__ }}/images/icons/icon__cart.svg" alt="icon__cart.svg"/>
						<span class="cart__total">
							6
						</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</header>
<div class="bs-modal" id="cartModal">
    <div class="modal-frame modal-left">
        <form class="content-modal">
            <div class="header-modal">
                <h3 class="modal__title">Giỏ hàng của bạn</h3>
                <button title="close" modal-show="close" class="btn close__modal">
                    <img src="{{ __BASE_URL__ }}/images/icons/x.svg" alt="x.svg" />
                </button>
            </div>
            <div class="body-modal">
                <div class="card__body">
                                        <div class="cart__group">
                        <div class="cart__avata">
                            <a href="#" class="frame">
                                <img src="{{ __BASE_URL__ }}/images/product__9.png" alt="product__9.png" />
                            </a>
                        </div>
                        <div class="cart__content">
                            <h2 class="cart__title">Moisturising Gel Line M</h2>
                            <div class="cart__size">100ml</div>
                            <div class="cart__price">
                                <span class="price"> 1.250.000 </span>
                                <span class="sale"> Giảm 10% </span>
                            </div>
                            <div class="cart__form">
                                <input type="number" value="1" />
                                <button class="btn btn__delete">Xóa</button>
                            </div>
                        </div>
                    </div>
                                        <div class="cart__group">
                        <div class="cart__avata">
                            <a href="#" class="frame">
                                <img src="{{ __BASE_URL__ }}/images/product__9.png" alt="product__9.png" />
                            </a>
                        </div>
                        <div class="cart__content">
                            <h2 class="cart__title">Moisturising Gel Line M</h2>
                            <div class="cart__size">100ml</div>
                            <div class="cart__price">
                                <span class="price"> 1.250.000 </span>
                                <span class="sale"> Giảm 10% </span>
                            </div>
                            <div class="cart__form">
                                <input type="number" value="1" />
                                <button class="btn btn__delete">Xóa</button>
                            </div>
                        </div>
                    </div>
                                        <div class="cart__group">
                        <div class="cart__avata">
                            <a href="#" class="frame">
                                <img src="{{ __BASE_URL__ }}/images/product__9.png" alt="product__9.png" />
                            </a>
                        </div>
                        <div class="cart__content">
                            <h2 class="cart__title">Moisturising Gel Line M</h2>
                            <div class="cart__size">100ml</div>
                            <div class="cart__price">
                                <span class="price"> 1.250.000 </span>
                                <span class="sale"> Giảm 10% </span>
                            </div>
                            <div class="cart__form">
                                <input type="number" value="1" />
                                <button class="btn btn__delete">Xóa</button>
                            </div>
                        </div>
                    </div>
                                        <div class="cart__group">
                        <div class="cart__avata">
                            <a href="#" class="frame">
                                <img src="{{ __BASE_URL__ }}/images/product__9.png" alt="product__9.png" />
                            </a>
                        </div>
                        <div class="cart__content">
                            <h2 class="cart__title">Moisturising Gel Line M</h2>
                            <div class="cart__size">100ml</div>
                            <div class="cart__price">
                                <span class="price"> 1.250.000 </span>
                                <span class="sale"> Giảm 10% </span>
                            </div>
                            <div class="cart__form">
                                <input type="number" value="1" />
                                <button class="btn btn__delete">Xóa</button>
                            </div>
                        </div>
                    </div>
                                        <div class="cart__group">
                        <div class="cart__avata">
                            <a href="#" class="frame">
                                <img src="{{ __BASE_URL__ }}/images/product__9.png" alt="product__9.png" />
                            </a>
                        </div>
                        <div class="cart__content">
                            <h2 class="cart__title">Moisturising Gel Line M</h2>
                            <div class="cart__size">100ml</div>
                            <div class="cart__price">
                                <span class="price"> 1.250.000 </span>
                                <span class="sale"> Giảm 10% </span>
                            </div>
                            <div class="cart__form">
                                <input type="number" value="1" />
                                <button class="btn btn__delete">Xóa</button>
                            </div>
                        </div>
                    </div>
                                        <div class="cart__group">
                        <div class="cart__avata">
                            <a href="#" class="frame">
                                <img src="{{ __BASE_URL__ }}/images/product__9.png" alt="product__9.png" />
                            </a>
                        </div>
                        <div class="cart__content">
                            <h2 class="cart__title">Moisturising Gel Line M</h2>
                            <div class="cart__size">100ml</div>
                            <div class="cart__price">
                                <span class="price"> 1.250.000 </span>
                                <span class="sale"> Giảm 10% </span>
                            </div>
                            <div class="cart__form">
                                <input type="number" value="1" />
                                <button class="btn btn__delete">Xóa</button>
                            </div>
                        </div>
                    </div>
                                    </div>
            </div>
            <div class="footer-modal">
                <div class="cart__total">
                    <span class="cart__total-name"> Tạm tính </span>
                    <span class="cart__total-number"> 2.000.000 </span>
                </div>
                <div class="cart__control">
                    <a href="page__cart.html" class="btn btn__view-cart">
                        Xem giỏ hàng
                    </a>
                    <a href="page__pay.html" class="btn btn__cart-play"> Thanh toán </a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="bs-modal" id="auThModal">
    <div class="modal-frame">
        <div class="content-modal">

            <div class="body-modal">
                <p>
                    Tạo tài khoản hoặc đăng nhập để xem đơn đặt hàng hoặc điều chỉnh thông tin cá nhân của bạn.
                </p>
            </div>
            <div class="footer-modal">
                <div class="cart__control">
                    <a href="page__create-account.html" class="btn btn__view-cart">
                        Tạo tài khoản
                    </a>
                    <a href="page__login.html" class="btn btn__cart-play"> Đăng nhập </a>
                </div>
            </div>
        </div>
    </div>
</div>
    <main id="main">
	<section class="page__phone-verification">
		<div class="module moduel-page__phone-verification">
			<div class="container">
				<div class="col-12 col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-8 offset-sm-2">
					<h1 class="verification__title text-center">
						Mã xác thực
					</h1>
					<p class="text-center">
						Chúng tôi đã gửi 1 mã OTP vào số điện thoại của bạn.
					</p>
					<form class="from">
						<input type="text" class="form-control input__account" placeholder="1246796"/>
						<button class="btn btn__check">
							<img src="{{ __BASE_URL__ }}/images/icons/check.svg" alt="check.svg"/>
						</button>
					</form>
					<button class="btn btn__secondary">Tiếp tục
					</button>
				</div>
			</div>
		</div>
	</section>

</main>
    <script src="{{ __BASE_URL__ }}/js/tool.min.js"></script>
<script src="{{ __BASE_URL__ }}/js/main.js"></script>  </body>

</html>
