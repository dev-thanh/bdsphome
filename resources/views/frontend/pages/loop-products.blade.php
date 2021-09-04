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