<header id="header">
    <div class="header-body header__active">
        <div class="container">
            <div class="header__banner">
                <a href="index.html" class="logo" title="gco Group">
                    <img src="images/icons/icon__logo-2.png" alt="icon__logo-2.png" />
                </a>
                <div class="header__contact">
                    <a href="tel:+(84) 36 956 0246" title="+(84) 36 956 0246">
                        +(84) 36 956 0246
                    </a>
                    <a href="mailto:info@dland.vn" title="info@dland.vn">info@dland.vn
                    </a>
                </div>
                <div class="box__menu">
                    <div class="box__container">
                        <ul class="menu">
                            <li class="menu__list ">
                                <a href="index.html" class="menu__link" title="Trang chủ">
                                    Trang chủ
                                </a>
                            </li>
                            <li class="menu__list active">
                                <a href="page__aboutUs.html" class="menu__link" title="Giới thiệu">
                                    Giới thiệu
                                </a>
                            </li>
                            <li class="menu__list ">
                                <a href="page__realEstate.html" class="menu__link" title="Bất động sản">
                                    Bất động sản
                                </a>
                            </li>
                            <li class="menu__list ">
                                <a href="page__service.html" class="menu__link" title="Dịch vụ">
                                    Dịch vụ
                                </a>
                            </li>
                            <li class="menu__list ">
                                <a href="page__project.html" class="menu__link" title="Dự án">
                                    Dự án
                                </a>
                            </li>
                            <li class="menu__list ">
                                <a href="page__news.html" class="menu__link" title="Tin tức">
                                    Tin tức
                                </a>
                            </li>
                            <li class="menu__list ">
                                <a href="page__contact.html" class="menu__link" title="Liên hệ">
                                    Liên hệ
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                @if(Auth::guard('customer')->check())
                    <div class="author">
                        <div class="author__header" id="toggleAuthor">
                            <span class="author__use">
                                <img src="{{url('/').'/public/images/avatar/'.auth('customer')->user()->image}}" alt="user__1.png" />
                            </span>
                            <span class="__name"> {{auth('customer')->user()->name}} </span>
                        </div>
                        <div class="author__body" id="bodyAuthor">
                            <div class="author__group">
                                <div class="author__avatar">
                                    <img src="{{url('/').'/public/images/avatar/'.auth('customer')->user()->image}}" alt="images/us__1.png" />
                                </div>
                                <div class="author__content">
                                    <h3>{{auth('customer')->user()->name}}</h3>
                                    <p>Nhà môi giới</p>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <a href="admin-post.html" title=" Quản lý tin đăng">Quản lý tin đăng</a>
                                </li>
                                <li>
                                    <a href="admin-user.html" title="Quản lý tài khoảng">Quản lý tài khoản</a>
                                </li>
                                <li>
                                    <a href="admin-change-password.html" title="Đổi mật khẩu">Đổi mật khẩu</a>
                                </li>
                                <li>
                                    <a href="{{route('home.logout')}}" title="Đăng xuất">Đăng xuất</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                <a href="javascript:void(0)" class="btn btn__login" title="Đăng nhập" modal-show="show" modal-data="#author">
                    Đăng nhập
                </a>
                @endif

                <button type="button" class="btn btn__menu">&#9776;</button>
            </div>
        </div>
    </div>
</header>