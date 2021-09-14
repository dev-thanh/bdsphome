<?php $routeName = request()->route()->getName(); ?>

<li class="header">TRANG QUẢN TRỊ</li>

<li class="{{ Request::segment(2) == 'home' ? 'active' : null  }}">
    <a href="{{ route('backend.home') }}">
        <i class="fa fa-home"></i> <span>Trang chủ</span>
    </a>
</li>
<li class="{{ Request::segment(2) == 'users' ? 'active' : null  }}">
    <a href="{{ route('users.index') }}">
        <i class="fa fa-user"></i> <span>Tài khoản</span>
    </a>
</li>

<li class="treeview {{ Request::segment(2) === 'categories-bds' || Request::segment(2) === 'projects' ? 'active' : null }}">

    <a href="#">

        <i class="fa fa-tags" aria-hidden="true"></i> <span>Bất động sản</span>

        <span class="pull-right-container">

        <i class="fa fa-angle-left pull-right"></i>

        </span>

    </a>

    <ul class="treeview-menu">



        <li class="{{ Request::segment(2) === 'bds' ? 'active' : null }}">

            <a href="{{ route('bds.index') }}"><i class="fa fa-circle-o"></i> Danh sách bất động sản</a>

        </li>



        <li class="{{ Request::segment(2) === 'categories-bds' ? 'active' : null }}">

            <a href="{{ route('categories-bds.index') }}"><i class="fa fa-circle-o"></i> Danh mục bất động sản</a>

        </li>
        <li class="{{ Request::segment(2) === 'categories-nd' ? 'active' : null }}">

            <a href="{{ route('categories-nd.index') }}"><i class="fa fa-circle-o"></i> Loại nhà đất</a>

        </li>

    </ul>

</li>

<li class="treeview {{ Request::segment(2) === 'categories-projects' || Request::segment(2) === 'projects' ? 'active' : null }}">

    <a href="#">

        <i class="fa fa-tags" aria-hidden="true"></i> <span>Dự án</span>

        <span class="pull-right-container">

        <i class="fa fa-angle-left pull-right"></i>

        </span>

    </a>

    <ul class="treeview-menu">



        <li class="{{ Request::segment(2) === 'projects' ? 'active' : null }}">

            <a href="{{ route('projects.index') }}"><i class="fa fa-circle-o"></i> Danh sách dự án</a>

        </li>



        <li class="{{ Request::segment(2) === 'categories-projects' ? 'active' : null }}">

            <a href="{{ route('categories-projects.index') }}"><i class="fa fa-circle-o"></i> Danh mục dự án</a>

        </li>

        <li class="{{ Request::segment(2) === 'company' ? 'active' : null }}">

            <a href="{{ route('company.index') }}"><i class="fa fa-circle-o"></i>Chủ đầu tư</a>

        </li>

    </ul>

</li>

<li class="treeview {{ Request::segment(2) === 'category' || Request::segment(2) === 'services' ? 'active' : null }}">

    <a href="#">

        <i class="fa fa-tags" aria-hidden="true"></i> <span>Dịch vụ</span>

        <span class="pull-right-container">

        <i class="fa fa-angle-left pull-right"></i>

        </span>

    </a>

    <ul class="treeview-menu">



        <li class="{{ Request::segment(2) === 'services' ? 'active' : null }}">

            <a href="{{ route('services.index') }}"><i class="fa fa-circle-o"></i> Danh sách dịch vụ</a>

        </li>



        <li class="{{ Request::segment(2) === 'category' ? 'active' : null }}">

            <a href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i> Danh mục dịch vụ</a>

        </li>

    </ul>

</li>

<li class="treeview {{ Request::segment(2) === 'categories-post' || Request::segment(2) === 'posts' ? 'active' : null }}">
    <a href="#">
        <i class="fa fa-building" aria-hidden="true"></i> <span>Tin tức</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::route()->getName() === 'posts.index' || Request::route()->getName() === 'posts.create' || Request::route()->getName() === 'posts.edit' ? 'active' : null }}">
            <a href="{{ route('posts.index') }}"><i class="fa fa-circle-o"></i> Danh sách tin tức</a>
        </li>
        <li class="{{ Request::segment(2) === 'categories-post' ? 'active' : null }}">
            <a href="{{ route('categories-post.index') }}"><i class="fa fa-circle-o"></i> Danh mục tin tức</a>
        </li>
    </ul>
</li>

<li class="{{ Request::segment(2) == 'pages' ? 'active' : null  }}">
    <a href="{{ route('pages.list') }}">
        <i class="fa fa-paper-plane" aria-hidden="true"></i> <span>Cài đặt trang</span>
    </a>
</li>

<li class="{{ Request::segment(2) == 'contact' ? 'active' : null  }}">
    <?php $number = \App\Models\Contact::where('status', 0)->count() ?>
    <a href="{{ route('get.list.contact') }}">
        <i class="fa fa-bell" aria-hidden="true"></i> <span>Liên hệ ({{ $number }})
        </span>
    </a>
</li>

<li class="{{ $routeName =='get.list.mail-sale' ? 'active' : null }}">
    <a href="{{ route('get.list.mail-sale') }}">
        <i class="fa fa-bell" aria-hidden="true"></i> <span>Email nhận tin khuyến mại
        </span>
    </a>
</li>

<li class="header">Cấu hình hệ thống</li>
<li class="treeview {{ Request::segment(2) === 'options' || Request::segment(2) === 'menu' || Request::segment(2) === 'policy' ? 'active' : null }}">
    <a href="#">
        <i class="fa fa-cog" aria-hidden="true"></i> <span>Cấu hình</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">

         <li class="{{ Request::segment(3) === 'general' ? 'active' : null }}">
            <a href="{{ route('backend.options.general') }}"><i class="fa fa-circle-o"></i> Cấu hình chung</a>
        </li>

        <li class="{{ Request::segment(2) === 'menu' ? 'active' : null }}">
            <a href="{{ route('setting.menu') }}"><i class="fa fa-circle-o"></i> Menu</a>
        </li>
        <li class="{{ request()->get('type') == 'slider' ? 'active' : null }}">

            <a href="{{ route('image.index', ['type'=> 'slider']) }}"><i class="fa fa-circle-o"></i> Slider</a>

        </li>
        <li class="{{ $routeName =='policy.list' || $routeName =='policy.add' || $routeName =='policy.edit' ? 'active' : null }}">

            <a href="{{ route('policy.list') }}"><i class="fa fa-circle-o"></i>Chính sách quy định(footer)</a>

        </li>

    </ul>
</li>

<div style="display: none;">
	<li class="header">Cấu hình hệ thống</li>
	<li class="treeview {{ Request::segment(2) == 'options' ? 'active' : null  }}">
		<a href="#">
			<i class="fa fa-folder"></i> <span>Setting (Developer)</span>
			<span class="pull-right-container">
				<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li class="{{ Request::segment(3) == 'developer-config' ? 'active' : null  }}">
				<a href="{{ route('backend.options.developer-config') }}"><i class="fa fa-circle-o"></i> Developer - Config</a>
			</li>
		</ul>
	</li>
</div>