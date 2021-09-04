<?php 
    $route = request()->route()->getName() ? request()->route()->getName() : '';
    $routename = request()->path();
    $search = request()->search !='' ? request()->search : '';
   //dd($site_info);
?>
<header id="header">
	<div class="container">
		<div class="header__top">
			<h1 class="logo">
				<a href="{{route('home.index')}}" class="logo__link" title="beheshop">
					<img src="{{ __BASE_URL__ }}/images/icons/icon__logo.png" alt="icon__logo.png"/>
				</a>
			</h1>
			<div class="header__control">
				<div class="header__control-item header__search">
					<a href="{{route('home.search')}}" class="search">

						<img src="{{ __BASE_URL__ }}/images/icons/icon__search.svg" alt="icon__search.svg"/>

					</a>
				</div>
                @if(auth()->guard('customer')->check())
                    <div class="header__control-item header__auth">
                        <a href="{{route('home.profile')}}">
                            <button class="btn" type="button">
                                <img src="{{ __BASE_URL__ }}/images/icons/icons__user.svg" alt="icons__user.svg"/>
                            </button>
                        </a>
                    </div>
                @else
                    <div class="header__control-item header__auth">
                        <button class="btn" type="button" modal-show="show" modal-data="#auThModal">
                            <img src="{{ __BASE_URL__ }}/images/icons/icons__user.svg" alt="icons__user.svg"/>
                        </button>
                    </div>
                @endif
				<div class="header__control-item header__cart">
					<button class="btn header__cart-link" title="Giỏ hàng" type="button" modal-show="show" modal-data="#cartModal">
						<img src="{{ __BASE_URL__ }}/images/icons/icon__cart.svg" alt="icon__cart.svg"/>
						<span class="cart__total cart__count">
							{{Cart::count()}}
						</span>
					</button>
				</div>
			</div>
		</div>
        @if(request()->route()->getName() !='home.register' && request()->route()->getName() !='home.login')
            <div class="header__scroll">
                <div class="container">
                    <div class="header__group">
                        <div class="addon-menu">
                            <div class="addon-menu__container">
                                <ul class="menu">
                                    @foreach($menuHeader as $k =>$item)
                                        @if ($item->parent_id == null)
                                        <li class="menu__list @if($item->url=='/'.$routename) active @elseif($item->url=='/' && $routename=='/') active @endif">
                                            <a href="{{url('/').$item->url}}" class="menu__item" title="{{$item->title}}">
                                                {{$item->title}}
                                            </a>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
	</div>
</header>
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
                    <a href="{{route('home.register')}}" class="btn btn__view-cart">
                        Tạo tài khoản
                    </a>
                    <a href="{{route('home.login')}}" class="btn btn__cart-play"> Đăng nhập </a>
                </div>
            </div>
        </div>
    </div>
</div>
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
                @if (Cart::count())
                <div class="card__body">
                    @foreach (Cart::content() as $item)
                    <div class="cart__group cart-group_{{$item->rowId}}">
                        <div class="cart__avata">
                            <a href="#" class="frame">
                            <img src="{{url('/').@$item->options->image}}" alt="{{$item->name}}" />
                            </a>
                        </div>
                        <div class="cart__content">
                            <h2 class="cart__title">{{$item->name}}</h2>
                            <div class="cart__size">{{@$item->options->volume}}</div>
                            <div class="cart__price">
                                <span class="price"> {{ number_format($item->price, 0, '.', '.') }}VND </span>
                                @if(!empty(@$item->options->sale_price))
                                <span class="sale"> Giảm {{@$item->options->sale_price}}% </span>
                                @endif
                            </div>
                            <div class="cart__form">
                                <input type="number" name="qty" data-id="{{$item->rowId}}" value="{{$item->qty}}" />
                                <span class="pr__color" style="background-color:{{@$item->options->color}}" title="màu sắc"></span>
                                <button class="btn btn__delete btn__delete_cart_item" data-rowid="{{$item->rowId}}" data-type="2">Xóa</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            <div class="footer-modal">
                @if (Cart::count())
                <div class="cart__total cart_empty">
                    <span class="cart__total-name"> Tạm tính </span>
                    <span class="cart__total-number"> {{number_format(Cart::total(), 0, '.', '.')}}VND </span>
                </div>
                @else
                <div class="cart__total">
                    Chưa có sản phẩm nào trong giỏ hàng
                </div>
                @endif
                <div class="cart__control">
                    <a href="{{route('home.cart')}}" class="btn btn__view-cart">
                        Xem giỏ hàng
                    </a>
                    <a href="{{route('home.check-out1')}}" class="btn btn__cart-play"> Thanh toán </a>
                </div>
                
            </div>
        </form>
    </div>
</div>