@extends('frontend.master')
@section('main')
    <main id="main">
        <div class="container">
            <ul class="breadcrumb__global">
                <li>
                    <a href="index.html" title="trang chủ">
                    Trang chủ
                    </a>
                </li>
                <li>
                    <a href="page__account.html" title="Skincare">
                    Tài khoản
                    </a>
                </li>
            </ul>
        </div>
        <section class="page__account">
            <div class="container">
                <div class="module module-page__account">
                    <div class="module__content">
                        <div class="bs-tab">
                            <div class="tab-container">
                                <div class="tab-control">
                                    <h3 class="auther__title btn">
                                        Tài khoản của tôi
                                        <button type="button" class=" btn__show btn fa fa-bars" aria-hidden="true"></button>
                                    </h3>
                                    <ul class="control-list">
                                        <li class="control-list__item active" tab-show="#tab1">Thông tin tài khoản</li>
                                        <li class="control-list__item" tab-show="#tab2">Đơn hàng</li>
                                        <li class="control-list__item" tab-show="#tab3">Điểm thưởng</li>
                                        <li class="control-list__item">
                                            <button type="button" class="btn" modal-show="show" modal-data="#logout">
                                            Đăng xuất
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-item active" id="tab1">
                                        <div class="account__container">
                                            <h3 class="account__title">
                                                Xin chào {{$profile->user_name}} !
                                            </h3>
                                            <div class="account__desc">
                                                <p>
                                                    Tại đây, bạn có thể theo dõi hoạt động gần đây của mình, yêu cầu ủy
                                                    <br/>
                                                    quyền trả lại / trao đổi đối với các đơn hàng bạn đã nhận, đồng thời
                                                    <br/>
                                                    xem và chỉnh sửa thông tin tài khoản hoặc danh sách các mặt hàng yêu thích.
                                                </p>
                                            </div>
                                            <div class="account__group">
                                                <div class="account__item">
                                                    <h3 class="account__title">
                                                        Thông tin liên hệ
                                                    </h3>
                                                    <ul>
                                                        <li>
                                                            {{$profile->user_name}}
                                                        </li>
                                                        @if($profile->provider_id !='')
                                                        <li>
                                                            {{$profile->email_social}}
                                                        </li>
                                                        @else
                                                        <li>
                                                            {{$profile->email}}
                                                        </li>
                                                        @endif
                                                        <li>
                                                            {{$profile->phone}}
                                                        </li>
                                                        <li>
                                                            <a href="{{route('home.edit-account')}}">
                                                            Chính sửa
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('home.edit-account')}}">
                                                            Thay đổi mật khẩu
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="account__item">
                                                    <h3 class="account__title">
                                                        Điểm thưởng
                                                    </h3>
                                                    <ul>
                                                        <li>
                                                            {{auth('customer')->user()->total_point}} Điểm
                                                        </li>
                                                        <li>
                                                            <p>
                                                                * Mỗi điểm thưởng tương đương với {{number_format(@$site_info->poin_price, 0, '.', '.')}}VND. Tích điểm bằng
                                                                <br/>cách mua sắm, mua sắm càng nhiều điểm thưởng càng nhiều.<br/>
                                                                Sử dụng điểm bằng cách nhập vào ô điểm thưởng trong phần
                                                                <br/>
                                                                thanh toán để được giảm giá đơn hàng.
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                            Lịch sử
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-item" id="tab2">
                                        <div class="account__order">
                                            <div class="order__control">
                                                <h3 class="order__control-title">
                                                    Đơn hàng của tôi
                                                </h3>
                                                <div class="order__date">
                                                    <div class="date__item">
                                                        <label class="fa fa-calendar-o" aria-hidden="true"></label>
                                                        <div>
                                                            <input id="datepicker" type="text" placeholder="Từ ngày ">
                                                        </div>
                                                    </div>
                                                    <div class="date__item">
                                                        <label class="fa fa-calendar-o" aria-hidden="true"></label>
                                                        <input id="datepicker2" type="text" placeholder="Đến ngày ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="order__table">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Mã đơn hàng</th>
                                                            <th scope="col">Ngày</th>
                                                            <th scope="col">Trạng thái</th>
                                                            <th scope="col">Tiền</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orders as $item)
                                                        <tr>
                                                            <td scope="row">{{$item->id}}</td>
                                                            <td>29.03.2021</td>
                                                            <td>Chờ giao hàng</td>
                                                            <td>1.930.000</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-item" id="tab3">
                                        <div class="account__order">
                                            <div class="order__control">
                                                <h3 class="order__control-title">
                                                    Điểm thưởng
                                                </h3>
                                                <div class="order__date">
                                                    <div class="date__item">
                                                        <label class="fa fa-calendar-o" aria-hidden="true"></label>
                                                        <div>
                                                            <input id="datepicker" type="text" placeholder="Từ ngày ">
                                                        </div>
                                                    </div>
                                                    <div class="date__item">
                                                        <label class="fa fa-calendar-o" aria-hidden="true"></label>
                                                        <input id="datepicker2" type="text" placeholder="Đến ngày ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="order__table">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Mã đơn hàng</th>
                                                            <th scope="col">Ngày</th>
                                                            <th scope="col">Tiền</th>
                                                            <th scope="col">Điểm</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td scope="row">95875</td>
                                                            <td>29.03.2021</td>
                                                            <td>1.930.000</td>
                                                            <td>
                                                                20
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row">26587</td>
                                                            <td>27.03.2021</td>
                                                            <td>950.000</td>
                                                            <td>30</td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row">36588</td>
                                                            <td>20.01.2021</td>
                                                            <td>950.000</td>
                                                            <td>15</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="bs-modal" id="logout">
            <div class="modal-frame">
                <div class="content-modal">
                    <div class="header-modal">
                        <h3 class="modal__title">Bạn có chắc muốn đăng xuất tài khoản ?</h3>
                    </div>
                    <div class="footer-modal">
                        <button modal-show="close" class="btn" type="button">Đóng</button>
                        <a class="btn btn__cart-play" href="{{route('home.logout')}}">
                        Có
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection