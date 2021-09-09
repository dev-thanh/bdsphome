@section('admin-css')
<link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/admins/admin-post-form.css" />
<link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/admins/admin-post-slidebar.css" />
<link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/admins/admin-cm-product.css" />
<link rel="stylesheet" type="text/css" href="{{ __BASE_URL__ }}/css/toastr.min.css" />
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
                    <a href="admin-post-form.html" class="btn btn__post" 'đăng tin'>
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
            <div class="post__main-form">
                <div class="card">
                    <h1 class="title__global">Chỉnh sửa tin đăng</h1>
                    <div class="form__add">
                        <h3 class="post__title">Vị trí</h3>
                        <div class="post__row">
                            <div class="post__col">
                                <span class="name__dots"> Tỉnh/Thành phố* </span>
                                <select name="city_id" id="">
                                    <option value="">Chọn Tỉnh/Thành phố</option>
                                    @foreach($city as $item)
                                    <option value="{{$item->id}}" >{{$item->city_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="post__col">
                                <span class="name__dots"> Tìm kiếm vị trí </span>
                                <input type="text" placeholder="Tìm kiếm..." />
                            </div>
                            <div class="post__col">
                                <span class="name__dots"> Quận/Huyện* </span>
                                <select name="district_id" id="">
                                    <option>Quận Huyện</option>
                                </select>
                            </div>
                            <div class="post__col">
                                <span class="name__dots"> Phường/Xã* </span>
                                <select name="ward_id" id="">
                                    <option>--Phường/Xã--</option>
                                </select>
                            </div>
                            <div class="post__col">
                                <span class="name__dots"> Địa chỉ cụ thể* </span>
                                <input type="text" placeholder="Địa chỉ cụ thể" name="address" />
                            </div>
                            <div class="post__col frame">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.8244482526165!2d108.24244441483707!3d16.0745970888776!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142178f470c24ad%3A0x288b1c7477f844fa!2zMTYyIFbDtSBOZ3V5w6puIEdpw6FwLCBQaMaw4bubYyBN4bu5LCBTxqFuIFRyw6AsIMSQw6AgTuG6tW5nIDU1MDAwMCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1627821454889!5m2!1svi!2s" width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="form__info">
                        <h3 class="post__title">Thông tin bất động sản</h3>
                        <div class="info__row">
                            <div class="info__col">
                                <span class="name__dots"> Đối tượng* </span>
                                <select name="" id="">
                                    <option>Môi giới</option>
                                </select>
                            </div>
                            <div class="info__col">
                                <span class="name__dots"> Nhu cầu* </span>
                                <select name="" id="">
                                    <option>Bán</option>
                                </select>
                            </div>
                            <div class="info__col">
                                <span class="name__dots"> Loại nhà đất* </span>
                                <select name="" id="">
                                    <option>Chung cư</option>
                                </select>
                            </div>
                            <div class="info__col">
                                <span class="name__dots"> Dự án </span>
                                <select name="" id="">
                                    <option>Takashi Ocean Suite Kỳ Co</option>
                                </select>
                            </div>
                            <div class="info__col info__group">
                                <div class="info__item">
                                    <span class="name__dots"> Diện tích đất (m2) </span>
                                    <input type="text" value="67" />
                                </div>
                                <div class="info__item">
                                    <span class="name__dots">
                                        Diện tích sử dụng (m2)
                                    </span>
                                    <input type="text" value="0" />
                                </div>
                            </div>
                            <div class="info__col info__group">
                                <div class="info__item">
                                    <span class="name__dots"> Giá* </span>
                                    <input type="text" value="67" />
                                </div>
                                <div class="info__item">
                                    <span class="name__dots"> Giá theo m2 </span>
                                    <input type="text" value="34.75 Triệu/m²" />
                                </div>
                            </div>
                        </div>
                        <div class="control__f">
                            <span class="name__dots"> Tiêu đề* </span>
                            <span class="total__text"> 0/100 Ký tự </span>
                        </div>
                        <textarea class="textarea__title"></textarea>

                        <div class="control__f">
                            <span class="name__dots"> Mô tả* </span>
                            <span class="total__text"> 0/100 Ký tự </span>
                        </div>
                        <textarea name="editor1" id="editor1"></textarea>

                        <span class="name__dots name__tag"> Tag </span>
                        <input type="text" placeholder="Thêm tag ..." class="input__tag" />
                        <div class="view__tag">
                            <span> Bán Căn hộ Takashi Ocean Suite Kỳ Co </span>
                            <span> Căn hộ Takashi Ocean Suite Kỳ Co </span>
                            <span> Căn hộ Takashi Ocean Suite </span>
                            <span> Căn hộ Takashi Ocean Suite </span>
                            <span> Bán Căn hộ Takashi Ocean Suite </span>
                        </div>
                        <div class="bs-tab">
                            <div class="tab-container">
                                <div class="tab-control">
                                    <ul class="control-list">
                                        <li class="control-list__item active" tab-show="#tab1">
                                            Ảnh bìa
                                        </li>
                                        <li class="control-list__item" tab-show="#tab2">
                                            Ảnh chi tiết
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-item active" id="tab1">
                                        <label for="file" class="upload__file">
                                            <input type="file" class="input__file" id="file" />
                                            <div class="frame__file"></div>
                                            <div class="frame__not">
                                                <div class="frame__icon">
                                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                                </div>
                                                <p class="text">
                                                    <span>Chọn tập tin </span> hoặc
                                                    <br />
                                                    kéo và thả ảnh để tải lên
                                                </p>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="tab-item" id="tab2">
                                        <label for="file" class="upload__file">
                                            <input type="file" class="input__file" id="file" />
                                            <div class="frame__file"></div>
                                            <div class="frame__not">
                                                <div class="frame__icon">
                                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                                </div>
                                                <p class="text">
                                                    <span>Chọn tập tin </span> hoặc
                                                    <br />
                                                    kéo và thả ảnh để tải lên
                                                </p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="post__item">
                <div class="card card__view">
                    <h2 class="title__global">Xem trước</h2>
                    <div class="product__global">
                        <a href="detail__real-estate.html" class="avatar__global" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
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
                                <a href="detail__real-estate.html" title="Căn hộ Officetel Sky Center Phổ Quang" tabindex="0">
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

                    <a href="#" class="btn btn__view"> Xem trước chi tiết tin đăng </a>
                </div>
                <div class="control__group">
                    <button class="btn btn__save">Cập nhật</button>
                    <button class="btn btn__cancel">Hủy</button>
                </div>
            </div>
        </section>
    </main>

@section('scrip-admin')
    <script src="{{ __BASE_URL__ }}/ckeditor/ckeditor.js"></script>
    <script>
        var base_url = '{{url('/')}}';
        $(document).ready(function() {
            CKEDITOR.replace("editor1");

            function addonTab() {
                $(".control-list__item").click(function() {
                    $(this).addClass("active");
                    $(this).siblings().removeClass("active");
                    $($(this).attr("tab-show")).slideDown();
                    $($(this).attr("tab-show")).siblings().slideUp();
                    $(this).parent(".control-list").removeClass("active");
                });
            }
            addonTab();
        });
    </script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/custom2.js"></script>
@endsection
@stop