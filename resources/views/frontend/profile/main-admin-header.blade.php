<header class="card" id="header">
    <div class="author__group">
        <div class="author__avatar">
            <img class="image_avatar_header" src="{{url('/').'/public/images/avatar/'.$auth->image}}" alt="{{$auth->name}}" />
        </div>
        <div class="author__content">
            <h3 class="author__name">{{$auth->name}}</h3>
            <p class="author__position">Nhà môi giới</p>
        </div>
    </div>
    <div class="notification">
        <div class="icon__notification active">
            <i class="fa fa-bell" aria-hidden="true"></i>
        </div>
    </div>
    <button class="btn btn__menu">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </button>
</header>