<?php //dd($site_info); ?>
<footer id="footer">
    <section class="footer__support">
        <div class="container">
            <div class="support__group">
                @if(!empty($site_info->social_header))
                @foreach($site_info->social_header as $item)
                <div class="support__item" data-aos="fade-up" data-aos-duration="3000">
                    <span class="support__icon">
                    <img src="{{url('/').@$item->image}}" alt="support__1.svg"/>
                    </span>
                    <h4 class="support__title">{{$item->title1}}</h4>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>
    <div class="footer__logo" data-aos="fade-up" data-aos-duration="3000">
        <a href="#" class="footer__link" title="beheshop">
        <img src="{{url('/').$site_info->logo_footer}}" alt="Logo"/>
        </a>
    </div>
    <div class="footer__body">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xs-6 col-sm-6 col-md-3" data-aos="fade-up" data-aos-duration="3000">
                    <h3 class="footer__title">Khám phá</h3>
                    <div class="footer__content">
                        <ul class="menu__footer">
                            @foreach($menuFooter2 as $k =>$item)
                            @if ($item->parent_id == null)
                            <li class="menu__list">
                                <a href="{{url('/').$item->url}}" class="menu__list-item" title="{{$item->title}}">
                                {{$item->title}}
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-xs-6 col-sm-6 col-md-3" data-aos="fade-up" data-aos-duration="3000">
                    <h3 class="footer__title">Cửa hàng</h3>
                    <div class="footer__content">
                        <ul class="menu__footer">
                            @foreach($menuFooter as $k =>$item)
                            @if ($item->parent_id == null)
                            <li class="menu__list">
                                <a href="{{url('/').$item->url}}" class="menu__list-item" title="{{$item->title}}">
                                {{$item->title}}
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-xs-6 col-sm-6 col-md-3" data-aos="fade-up" data-aos-duration="3000">
                    <h3 class="footer__title">Mạng xã hội</h3>
                    <div class="footer__content">
                        <ul class="menu__footer">
                        @if(!empty($site_info->social))
                        @foreach($site_info->social as $item)
                            <li class="menu__list">
                                <a href="{{$item->link}}" target="_blank" class="menu__list-item" title="{{$item->name}}">
                                {!!$item->image!!}
                                <span class="name">
                                {{$item->name}}
                                </span>
                                </a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-xs-6 col-sm-6 col-md-3" data-aos="fade-up" data-aos-duration="3000">
                    <h3 class="footer__title">Đăng ký</h3>
                    <div class="footer__content">
                        <form class="from" id="form-send-sale" action="{{route('home.send-sale')}}" method="POST">
                            @csrf
                            <input type="text" name="email" class="form-control form__input" placeholder="Email"/>
                            <button class="btn btn__send btn-send-sale" type="button">
                            <img src="{{ __BASE_URL__ }}/images/icons/icon__send.png" alt="icon__send.png"/>
                            </button>
                        </form>
                        <div class="footer__desc">
                            {{$site_info->sale_desc}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__copy-right">
        <div class="container">
            <div class="copy__group" data-aos="fade-up" data-aos-duration="3000">
                <div class="copy"></div>
                <div class="play__cart">
                    @if(!empty($site_info->payment_methods))
                    @foreach($site_info->payment_methods as $item)
                    <a href="#" class="play__cart-item">
                    <img src="{{url('/').$item->image}}" alt="{{$item->title}}"/>
                    </a>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>