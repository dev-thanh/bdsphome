@foreach($news as $val)
    <div class="new">
        <a href="{{route('home.services-single',['slug'=>$val->slug])}}" class="frame">
            <img src="{{url('/').$val->image}}" alt="{{$val->name}}" />
        </a>
        <div class="new__content">
            <time class="new__time">
                {{format_datetime($val->created_at,'d/m/Y')}}
            </time>
            <h3 class="new__title">
                <a href="{{route('home.services-single',['slug'=>$val->slug])}}" title="{{$val->name}}">
                    {{$val->name}}
                </a>
            </h3>
            <div class="new__desc">
                {!! $val->desc !!}
            </div>
            <a href="{{route('home.services-single',['slug'=>$val->slug])}}" class="btn btn__global" title="Chi tiết">
                Chi tiết
            </a>
        </div>
    </div>
@endforeach