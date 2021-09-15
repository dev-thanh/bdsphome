<ul class="post__menu">
    <li class="@if(request()->route()->getName()=='admin.post-management') active @endif">
        <a href="{{route('admin.post-management')}}" title="Tất cả tin đăng">
            <span class="icon">
                <img src="{{ __BASE_URL__ }}/images/admin/icon__1.png" alt="icon__1.png" />
            </span>
            <span class="name">
                Tất cả tin đăng
            </span>
        </a>
    </li>
    <li class="@if(request()->route()->getName()=='admin.news-posting') active @endif">
        <a href="{{route('admin.news-posting')}}" title="Tin đang đăng">
            <span class="icon">
                <img src="{{ __BASE_URL__ }}/images/admin/icon__2.png" alt="icon__2.png" />
            </span>
            <span class="name">
                Tin đang đăng
            </span>
        </a>
    </li>
    <li class="@if(request()->route()->getName()=='admin.news-down') active @endif">
        <a href="{{route('admin.news-down')}}" title="Tin bị hạ">
            <span class="icon">
                <img src="{{ __BASE_URL__ }}/images/admin/icon__3.png" alt="icon__3.png" />
            </span>
            <span class="name">
                Tin bị hạ
            </span>
        </a>
    </li>
    <li class="@if(request()->route()->getName()=='admin.draft-news') active @endif">
        <a href="{{route('admin.draft-news')}}" title="Tin nháp">
            <span class="icon">
                <img src="{{ __BASE_URL__ }}/images/admin/icon__4.png" alt="icon__4.png" />
            </span>
            <span class="name">
                Tin nháp
            </span>
        </a>
    </li>
    <li class="@if(request()->route()->getName()=='admin.news-expired') active @endif">
        <a href="{{route('admin.news-expired')}}" title="Tin hết hạn">
            <span class="icon">
                <img src="{{ __BASE_URL__ }}/images/admin/icon__5.png" alt="icon__5.png" />
            </span>
            <span class="name">
                Tin hết hạn
            </span>
        </a>
    </li>
</ul>