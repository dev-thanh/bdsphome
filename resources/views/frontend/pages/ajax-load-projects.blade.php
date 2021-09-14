@foreach($news as $val)
<div class="project__item">
    <a href="{{route('home.single-project',['slug'=>$val->slug])}}" class="project__box" title="Aqua City">
        <div class="frame">
            <img src="{{url('/').$val->image}}" alt="project_1.png">
        </div>
        <div class="project__content">
            <div class="project__address">
                {{$val->address}}
            </div>
            <h3 class="project__title">
                {{$val->name}}
            </h3>
            <span href="{{route('home.single-project',['slug'=>$val->slug])}}" class="btn btn__global" title="Chi tiết">
                Chi tiết
            </span>
        </div>
    </a>
</div>
@endforeach