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

                    @include('frontend.profile.quanly-tindang')
                </div>
            </div>
            <div class="post__main">
                <div class="card">
                    <h1 class="title__global">Tất cả tin đăng</h1>
                    <div class="product__group">
                        @foreach($bds as $item)
                        <div class="product__global">
                            <a href="admin-post-form-edit.html" class="avatar__global" title="{{$item->title}}" tabindex="0">
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
                                        {{$item->title}}
                                    </a>
                                </h3>
                                <div class="tags__group">
                                    <span class="tags__item"> {{$item->land_area}} m² </span>
                                    @if($item->number_floors)
                                    <span class="tags__item">
                                        {{$item->number_floors}} tầng
                                    </span>
                                    @endif
                                    @if(!empty($item->bedroom))
                                    <span class="tags__item"> {{$item->bedroom}} Phòng ngủ </span>
                                    @endif
                                </div>
                                <div class="tags__group">
                                    @if(!empty($item->direction_house))
                                    <span class="tags__item">{{huongNha($item->direction_house)}}</span>
                                    @endif
                                    @if(!empty($item->legal_papers))
                                    <span class="tags__item">{{$item->legal_papers}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- <ul class="addon__pagination">
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
                    </ul> -->
                </div>
            </div>
        </section>
    </main>
@stop