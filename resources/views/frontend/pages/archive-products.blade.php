@extends('frontend.master')
@section('main')
<main id="main">
    <div class="container">
        <ul class="breadcrumb__global">
            <li>
                <a href="{{route('home.index')}}" title="trang chủ">
                Trang chủ
                </a>
            </li>
            <li>
                <a href="{{route('home.list.product')}}" title="Sản phẩm">
                    Sản phẩm
                </a>
            </li>
        </ul>
    </div>
    <section class="page__product">
        <div class="module moduel-page__product">
            <div class="module__content">
                @if(count($data))
                <div class="filter__global">
                    <div class="container">
                        <div class="filter__global-group">
                            @foreach ($filters as $filter)
                                <?php $indexLoop = $loop->index + 2; ?>
                                <div class="filter__global-item">
                                    <div class="filter__global-header">{{$filter->name}}</div>
                                    @if(!empty($filter->content))
                                    <?php $content = json_decode($filter->content); ?>
                                    <div class="filter__global-body">
                                        @foreach ($content->filter as $key => $value)
                                        @if ($filter->type == 'category')
                                        <label class="checkbox__item">
                                        <input type="checkbox" id="filter-{{ $key }}" name="filter-{{ $indexLoop }}" value="{{ $value->category_id }}" data-vl="{{ $value->category_id }}" data-type="{{ $filter->type }}"
							 	class="filter-check-box check-box-filter {{ $filter->type }}" data-id="input-{{ $filter->type }}" data-name="{{ $value->name }}">
                                        <span class="chekbox__name">
                                        {{ $value->name }}
                                        </span>
                                        </label>
                                        @else
                                        <label class="checkbox__item">
                                        <input type="checkbox" id="filter-{{ $key }}" name="filter-{{ $indexLoop }}" value="{{ @$value->value }}" data-type="{{ $filter->type }}"
							 	class="filter-check-box check-box-filter {{ $filter->type }}" data-id="input-{{ $filter->type }}" data-name="{{ @$value->name }}">
                                        <span class="chekbox__name">
                                        {{ $value->name }}
                                        </span>
                                        </label>
                                        @endif
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                <input type="hidden" id="input-{{ $filter->type }}" value="" class="input-param" data-type="{{ $filter->type }}">
                            @endforeach
                            <input type="hidden" value="product-page" id="category_base">

                            <div class="filter__global-item sort">
                                <div class="filter__global-header sort__header">
                                    Sắp xếp
                                </div>
                                <div class="filter__global-body sort__body">
                                    <a href="#" class="sort__name">
                                    Bán chạy nhất
                                    </a>
                                    <a href="#" class="sort__name">
                                    Giá: Thấp đến cao
                                    </a>
                                    <a href="#" class="sort__name">
                                    Giá:Từ cao đến thấp
                                    </a>
                                    <a href="#" class="sort__name">
                                    Mới
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="show__global" data-aos="fade-up" data-aos-duration="3000">
                        <!-- <label for="" class="show__item">
                        <span class="show__item-n">
                        Face
                        </span>
                        <button type="button" class="btn btn__close">x</button>
                        </label> -->
                    </div>
                </div>
                <div class="page__product-main">
                    <div class="container">
                        <div class="row" id="list-products">
                            @foreach($data as $item)
                            <div class="col-12 col-xs-6 col-sm-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-duration="3000">
                                <div class="product__global">
                                    <div class="product__avata-global">
                                        <a href="{{route('home.single.product',['slug'=>$item->slug])}}" class="frame" title="{{$item->name}}">
                                        <img class="img__global" src="{{url('/').$item->image}}" alt="{{$item->name}}"/>
                                        <img class="img__hover-global" src="{{url('/').$item->image_hover}}" alt="{{$item->name}}"/>
                                        </a>
                                    </div>
                                    <div class="product__content-global">
                                        <div class="product__function-global">
                                        <?php $cate = $item->category;
                                            $string1 = '';
                                            foreach($cate as $k => $val){
                                                if($k!=0){
                                                    $string1=$string1.', '.$val->name;
                                                }else{
                                                    $string1=$string1.$val->name;
                                                }
                                            }
                                        ?>
                                        {{$string1}}
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
                </div>
                @else
                <div class="no-products">Dữ liệu đang được cập nhât</div>
                @endif
            </div>
        </div>
    </section>
</main>
@endsection