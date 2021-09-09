@section('admin-css')
<link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/admins/admin-post.css" />
<link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/admins/admin-post-slidebar.css" />
<link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/admins/admin-cm-product.css" />
@stop
@extends('frontend.profile.general')
@section('main-admin')
    <main id="main">
        @include('frontend.profile.main-admin-header')
        <section class="page__post">
            <div class="post__item">
                <div class="post__sidebars card">
                    <h2 class="title__global">Quản lý tin đăng</h2>
                    <form action="#" class="form__search">
                        <input type="text" placeholder="Tìm kiếm tin đăng" />
                        <button class="btn btn__search">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                    <a href="{{route('admin.add-post')}}" class="btn btn__post">
                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                        Đăng tin
                    </a>

                    <ul class="post__menu">
                        <li class="active">
                            <a href="admin-post.html" title="Tất cả tin đăng">
                                <span class="icon">
                                    <img src="{{ __BASE_URL__ }}/images/admin/icon__1.png" alt="icon__1.png" />
                                </span>
                                <span class="name">
                                    Tất cả tin đăng
                                </span>
                            </a>
                        </li>
                        <li class="">
                            <a href="admin-post.html" title="Tin đang đăng">
                                <span class="icon">
                                    <img src="{{ __BASE_URL__ }}/images/admin/icon__2.png" alt="icon__2.png" />
                                </span>
                                <span class="name">
                                    Tin đang đăng
                                </span>
                            </a>
                        </li>
                        <li class="">
                            <a href="admin-post.html" title="Tin bị hạ">
                                <span class="icon">
                                    <img src="{{ __BASE_URL__ }}/images/admin/icon__3.png" alt="icon__3.png" />
                                </span>
                                <span class="name">
                                    Tin bị hạ
                                </span>
                            </a>
                        </li>
                        <li class="">
                            <a href="admin-post.html" title="Tin nháp">
                                <span class="icon">
                                    <img src="{{ __BASE_URL__ }}/images/admin/icon__4.png" alt="icon__4.png" />
                                </span>
                                <span class="name">
                                    Tin nháp
                                </span>
                            </a>
                        </li>
                        <li class="">
                            <a href="admin-post.html" title="Tin hết hạn">
                                <span class="icon">
                                    <img src="{{ __BASE_URL__ }}/images/admin/icon__5.png" alt="icon__5.png" />
                                </span>
                                <span class="name">
                                    Tin hết hạn
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="post__main">
                <div class="card">
                    <h1 class="title__global">Tất cả tin đăng</h1>
                    <div class="product__group">
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                <div class="frame">
                                    <img src="{{ __BASE_URL__ }}/images/admin/product__1.png" alt="product__1.png" />
                                </div>
                                <span class="price__global"> 2.15 Tỷ </span>
                            </a>
                            <div class="content__global">
                                <a href="https://goo.gl/maps/aYsBuekuAGLvgvj76" target="_bank" class="address__global" title="click để xem google maps" tabindex="0">
                                    Quận Tân Bình, TP. Hồ Chí Minh
                                </a>
                                <h3 class="title__global">
                                    <a href="admin-post-form-edit.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
                                        Căn hộ Officetel Sky Center Phổ Quang
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> 67 m² </span>
                                    <span class="tags__item"> Ngõ 1 ô tô </span>
                                    <span class="tags__item"> 2 Phòng ngủ </span>
                                </div>
                                <div class="tags__group">
                                    <span class="tags__item">Đông nam </span>
                                    <span class="tags__item">Chính chủ </span>
                                    <span class="tags__item"> Đã có sổ </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="addon__pagination">
                        <li class="addon__pagination-item">
                            <a href="#" class="addon__pagination-item-link">
                                <img src="{{ __BASE_URL__ }}/images/admin/icon__prev.png" alt="icon__next.png">
                            </a>
                        </li>
                        <li class="addon__pagination-item active">
                            <a href="#" class="addon__pagination-item-link">1</a>
                        </li>
                        <li class="addon__pagination-item">
                            <a href="#" class="addon__pagination-item-link">2</a>
                        </li>
                        <li class="addon__pagination-item">
                            <a href="#" class="addon__pagination-item-link">3</a>
                        </li>
                        <li class="addon__pagination-item">
                            <a href="#" class="addon__pagination-item-link addon__next">
                                <img src="{{ __BASE_URL__ }}/images/admin/icon__next.png" alt="icon__next.png">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </main>
@stop