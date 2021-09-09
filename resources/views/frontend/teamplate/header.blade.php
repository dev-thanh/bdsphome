<?php 
    $route = request()->route()->getName() ? request()->route()->getName() : '';
    $routename = request()->path();
    $search = request()->search !='' ? request()->search : '';
   //dd($site_info);
?>
<style>
    .modal__author .content-modal .body-modal .form__register .btn__captcha{
        width: unset;
    }
</style>
<header id="header">
    <div class="header-body @if(request()->route()->getName()=='home.about') header__active @endif">
        <div class="container">
            <div class="header__banner">
                <a href="index.html" class="logo" title="gco Group">
                    <img src="https://tpl.gco.vn/bds/images/icons/icon__logo.png" alt="icon__logo.png" />
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
                            <li class="menu__list active">
                                <a href="index.html" class="menu__link" title="Trang chủ">
                                    Trang chủ
                                </a>
                            </li>
                            <li class="menu__list ">
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

<div class="bs-modal modal__author" id="author">
    <div class="modal-frame">
        <div class="content-modal">
            <!-- login -->
            <div id="logIn">
                <div class="header-modal">
                    <a href="index.html" class="modal__logo" title="trang chủ">
                        <img src="https://tpl.gco.vn/bds/images/icons/icon__logo-2.png" alt="icon__logo-2.png" />
                    </a>
                    <span title="close" modal-show="close" class="close__modal">
                        x
                    </span>
                </div>
                <div class="body-modal">
                    <form class="form__modal" action="{{route('home.post-login')}}" method="POST">
                        @csrf
                        <input type="tex" placeholder="Tên đăng nhập" name="email"/>
                        <span class="fr-error fr-error_name"></span>
                        <div class="form__group">
                            <input id="inputPass" type="password" placeholder="Mật khẩu" name="password"/>
                            <span class="fr-error fr-error_password"></span>
                            <button type="button" class="btn icon" id="btnShowPass">
                                <img src="https://tpl.gco.vn/bds/images/icons/icon__view.png" alt="icon__view.png" />
                            </button>
                        </div>
                        <span class="fr-error fr-error_login_error"></span>
                        <button type="button" class="btn btn__send btn_send_login">
                            Đăng nhập
                        </button>

                        <div class="group__pas">
                            <label class="memory__check" for="check__ps">
                                <input type="checkbox" id="check__ps" />
                                <span>
                                    Nhớ tài khoản
                                </span>
                            </label>
                            <a class="forgot__pass" href="#" class="#">
                                Quên mật khẩu
                            </a>
                        </div>

                        <div class="modal__action">
                            <a href="#">
                                <span class="icon">
                                    <img src="https://tpl.gco.vn/bds/images/icons/icon__facebook-modal.png" alt="icon__facebook-modal.png" />
                                </span>
                                <span class="span__text">
                                    Đăng nhập bằng
                                    <br />Facebook
                                </span>
                            </a>
                            <a href="#">
                                <span class="icon">
                                    <img src="https://tpl.gco.vn/bds/images/icons/icon__google-modal.png" alt="icon__google-modal.png" />
                                </span>
                                <span class="span__text">
                                    Đăng nhập bằng
                                    <br />
                                    Google
                                </span>
                            </a>
                        </div>
                    </form>
                </div>
                <div class="footer-modal">
                    <p>Bạn chưa có tài khoản?</p>
                    <a href="javascript:void(0)" class="toggleAuthor">
                        Đăng ký ngay
                    </a>
                </div>
            </div>
            <!-- end login -->
        
            <!-- registration -->
            <div id="registration">
                <div class="header-modal">
                    <a href="index.html" class="modal__logo" title="trang chủ">
                        <img src="https://tpl.gco.vn/bds/images/icons/icon__logo-2.png" alt="icon__logo-2.png" />
                    </a>
                    <span title="close" modal-show="close" class="close__modal">
                        x
                    </span>
                </div>
                <div class="body-modal">
                    <form class="form__modal form__res form__register" action="{{route('home.post-register')}}" method="POST">
                        <div>
                            <input type="tex" placeholder="Tên đăng nhập*" name="user_name"/>
                            <span class="fr-error fr-error_user_name"></span>
                        </div>
                        <div>
                            <input type="email" placeholder="Địa chỉ Email*" name="email"/>
                            <span class="fr-error fr-error_email"></span>
                        </div>
                        <div>
                            <input type="password" placeholder="Mật khẩu*" name="password"/>
                            <span class="fr-error fr-error_password"></span>
                        </div>
                        <div>
                            <input type="password" placeholder="Nhập lại mật khẩu*" name="password_confirmation"/>
                            <span class="fr-error fr-error_password_confirmation"></span>
                        </div>
                        <div>
                            <input type="text" placeholder="Họ và tên*" name="name"/>
                            <span class="fr-error fr-error_name"></span>
                        </div>
                        <div>
                            <input type="text" placeholder="Số điện thoại *" name="phone"/>
                            <span class="fr-error fr-error_phone"></span>
                        </div>
                        
                        <div class="captcha__group">
                            <div style="padding-right: 5px">

                                <input type="text" id="CaptchaCode" name="CaptchaCode" class="btn btn__captcha" placeholder="Mã xác nhận" name=""/>
                                <span class="fr-error fr-error_CaptchaCode"></span>
                            </div>
                            {!! captcha_image_html('ExampleCaptcha') !!}
                            
                        </div>
                        <div class="info">
                            <p>
                                * Bằng cách nhấn vào Đăng ký, bạn đồng ý với các
                                <a href="#">
                                    Điều khoản thỏa thuận, Quy chế hoạt động,
                                    Chính sách bảo mật thông tin, Cơ chế giải
                                    quyết khiếu nại, Quy định về báo giá và hỗ
                                    trợ
                                </a>
                                và các quy định có liên quan khác được công khai
                                trên dland.com.vn.
                            </p>
                            <p>
                                *
                                <span class="text__red">
                                    Chú ý:
                                </span>
                                Thông
                                tin Tên đăng nhập, email, số điện thoại di động
                                không thể thay đổi sau khi đăng ký.
                            </p>
                        </div>
                        <button type="button" class="btn btn__send btn_send_register_account">
                            Đăng ký
                        </button>
                    </form>
                </div>
                <div class="footer-modal">
                    <p>Bạn đã có tài khoản?</p>
                    <a href="javascript:void(0)" class="toggleAuthor">
                        Đăng nhập
                    </a>
                </div>
            </div>
            <!-- end registration -->
        </div>
    </div>
</div>