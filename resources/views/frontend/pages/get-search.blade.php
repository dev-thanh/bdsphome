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
                    <a href="page__search.html" title="Tìm kiếm">
                    Tìm kiếm
                    </a>
                </li>
            </ul>
        </div>
        <section class="page__search">
            <div class="module moduel-page__search">
                <div class="module__header">
                    <div class="container">
                        <div class="col-12 col-xl-7 col-sm-12">
                            <h2 class="search__title">
                                Chúng tôi có thể giúp gì cho bạn?
                            </h2>
                            <div class="search__content">
                                <form class="from">
                                    <input type="text" class="form-control form__input" name="search" placeholder="Bạn đang tìm..."/>
                                    <button type="submit" class="btn btn__search">
                                    <img src="{{ __BASE_URL__ }}/images/icons/icon__search.png" alt="Search"/>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @if($products!=null)
                <div class="module__content">
                    <div class="search__result">
                        <div class="bs-tab">
                            <div class="tab-container">
                                <div class="tab-control">
                                    <div class="container">
                                        <ul class="control-list">
                                            <li class="control-list__item active" tab-show="#tab1">Sản phẩm ({{count($products)}})</li>
                                            <li class="control-list__item" tab-show="#tab2">Tin tức ({{count($posts)}})</li>
                                        </ul>
                                        <div class="filter__global">
                                            <div class="filter__global-group">
                                                <div class="filter__global-item sort">
                                                    <div class="filter__global-header sort__header">
                                                        Sắp xếp
                                                    </div>
                                                    <div class="filter__global-body sort__body">
                                                        <a href="#" class="sort__name">
                                                        Giá tăng dần
                                                        </a>
                                                        <a href="#" class="sort__name">
                                                        Giá giảm dần
                                                        </a>
                                                        <a href="#" class="sort__name">
                                                        Mới nhất
                                                        </a>
                                                        <a href="#" class="sort__name">
                                                        Cũ nhất
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="container">
                                        <div class="tab-item active" id="tab1">
                                            <div class="row">
                                                @foreach($products as $item)
                                                <div class="col-12 col-xs-6 col-sm-6 col-md-3">
                                                    <div class="product__global">
                                                        <div class="product__avata-global">
                                                            <a href="{{route('home.single.product',['slug'=>$item->slug])}}" class="frame" title="{{$item->name}}">
                                                            <img class="img__global" src="{{url('/').$item->image}}" alt="{{$item->name}}"/>
                                                            <img class="img__hover-global" src="{{url('/').$item->image_hover}}" alt="{{$item->name}}"/>
                                                            </a>
                                                        </div>
                                                        <div class="product__content-global">
                                                            <div class="product__function-global">
                                                                @foreach($item->category as $val)
                                                                {{$val->name}}
                                                                @endforeach
                                                            </div>
                                                            <h3 class="product__title-global">
                                                                <a href="{{route('home.single.product',['slug'=>$item->slug])}}" title="{{$item->name}}">
                                                                    {{$item->name}}
                                                                </a>
                                                            </h3>
                                                            <div class="product__price-global">
                                                                <span class="global__price">
                                                                    {{ number_format($item->regular_price, 0, '.', '.') }}VND
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-item" id="tab2">
                                            <div class="row">
                                                @foreach($posts as $item)
                                                <div class="col-12 col-xs-6 col-ms-6 col-md-4">
                                                    <div class="new__global">
                                                        <div class="new__global-avata">
                                                            <a href="{{route('home.news-single',['slug'=>$item->slug])}}" class="frame" title="{{$item->name}}">
                                                            <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                                                            </a>
                                                        </div>
                                                        <div class="new__global-content">
                                                            <h3 class="new__global-title">
                                                                <a href="{{route('home.news-single',['slug'=>$item->slug])}}" title="{{$item->name}}">
                                                                {{$item->name}}
                                                                </a>
                                                            </h3>
                                                            <ul class="new__global-tag">
                                                                @foreach($item->category as $val)
                                                                <li>
                                                                    {{$val->name}}
                                                                </li>
                                                                @endforeach
                                                                @if(!empty($item->minute))
                                                                <li>
                                                                    <span>
                                                                    {{$item->minute}} PHÚT ĐỌC
                                                                    </span>
                                                                </li>
                                                                @endif
                                                            </ul>
                                                            <div class="new__global-desc">
                                                                <p>
                                                                    {{$item->desc}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>
    </main>
@endsection