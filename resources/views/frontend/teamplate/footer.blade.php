<footer id="footer">
    <div class="container">
        <div class="footer__res">
            <h3 class="res__title">Đăng ký nhận tin</h3>
            <div class="res__item">
                <div class="res__desc">
                    {{@$site_info->sale_desc}}
                </div>
            </div>
            <form class="res__form" action="{{route('home.send-sale')}}" id="form-send-sale" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Email của bạn" />
                <button type="button" class="btn btn__res btn-send-sale">
                    <img src="{{ __BASE_URL__ }}/images/icons/icon__send.png" alt="icon__send.png" />
                    <span> Đăng ký </span>
                </button>
            </form>
        </div>
    </div>
    <div class="footer__body">
        <div class="container">
            <div class="top__group">
                <div class="footer__item">
                    <a href="index.html" class="logo">
                        <img src="{{ __BASE_URL__ }}/images/icons/icon__logo-f.png" alt="" />
                    </a>
                    <div class="footer__content">
                        <h3 class="footer__title">Công ty Cổ phần D LAND</h3>
                        <div class="footer__desc">
                            <a href="https://goo.gl/maps/WkmdL9Zp2T7qJuND6" target="_bank" title="click để xem bản đồ">
                                162 Võ Nguyên Giáp, Ngũ Hành Sơn, Đà Nẵng
                            </a>
                            <a href="tel:+(84) 36 956 0246" title="Số điện thoại">
                                +(84) 36 956 0246
                            </a>
                        </div>
                    </div>
                </div>
                <div class="footer__item">
                    <h2 class="footer__title">Chính sách - Quy định</h2>
                    <ul>
                        @foreach($menuFooter as $item)
                        <li>
                            <a href="{{url('/').$item->url}}" title="{{$item->title}}">{{$item->title}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @if(!empty($site_info->social))
                <div class="footer__item">
                    <h3 class="footer__title">Kết nối với chúng tôi</h3>
                    <div class="society">
                        @foreach($site_info->social as $social)
                        <a href="{{@$social->link}}" class="society__link" title="{{@$social->title}}" target="_blank">
                            <img src="{{url('/').@$social->image}}" alt="{{@$social->title}}" />
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            @if(!empty($site_info->office))
            <div class="adds__group">
                @foreach($site_info->office as $item)
                <div class="item">
                    <h3 class="footer__title">{{$item->name}}</h3>
                    <a href="" target="_bank" title="click xem bản đồ">
                        {{$item->address}}
                    </a>
                    <a href="tel:+(84) 36 956 0246" title="Số điện thoại">
                        {{$item->phone}}
                    </a>
                </div>
                @endforeach
            </div>
            @endif
            <div class="bottom__group">
                <div class="item">
                    <p>
                        Giấy ĐKKD số 0104630479 do Sở KHĐT TP Đà Nẵng cấp lần
                        đầu ngày 02/06/2010
                    </p>
                    <p>
                        Giấy phép ICP số 2399/GP-STTTT do Sở TTTT Đà Nẵng cấp
                        ngày 04/09/2014
                    </p>
                    <p>
                        Giấy phép GH ICP số 3832/GP-TTĐT do Sở TTTT Đà Nẵng cấp
                        ngày 08/08/2019
                    </p>
                    <p>
                        Giấy phép SĐ, BS GP ICP số 3833/GP-TTĐT do Sở TTTT Đà
                        Nẵng cấp ngày 08/08/2019
                    </p>
                </div>
                <div class="item">© Copyright 2021 D LAND by GCO Software</div>
            </div>
        </div>
    </div>
</footer>