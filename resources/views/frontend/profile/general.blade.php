<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="robots" , content="index, follow">
    <meta name="_token" content="{{csrf_token()}}" />
    <title>
        Quản lý tin đăng </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="icon" , href="{{ __BASE_URL__ }}/images/icons/favicon-16x16.png" , type="image/x-icon" , sizes="16x16" />
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/admin-tool.css">
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/admin-main.css" />
    <link rel="stylesheet" type="text/css" href="{{ __BASE_URL__ }}/css/toastr.min.css" />
    @yield('admin-css')
</head>

<body>
    <div class="wrapper">
        <div class="sidebars">
            <div class="sidebars__logo">
                <a href="{{route('home.index')}}" class="logo__link" title="#">
                    <img src="{{ __BASE_URL__ }}/images/admin/icon__logo.png" alt="icon__logo.png">
                </a>
            </div>
            <div class="sidebars__body">
                <ul class="menu">
                    <li class="">
                        <a href="{{route('home.index')}}" title="Trang chủ" class="menu__link">
                            <span class="menu__icon">
                                <img src="{{ __BASE_URL__ }}/images/admin/icon__home.png" alt="icon__home.png">
                            </span>
                            <span class="menu__name">
                                Trang chủ
                            </span>
                        </a>

                    </li>
                    <li @if(request()->route()->getName() == 'admin.post-management') class="active" @endif >
                        <a href="{{route('admin.post-management')}}" title="Quản lý tin đăng" class="menu__link">
                            <span class="menu__icon">
                                <img src="{{ __BASE_URL__ }}/images/admin/icon__file.png" alt="icon__file.png">
                            </span>
                            <span class="menu__name">
                                Quản lý tin đăng
                            </span>
                        </a>

                    </li>
                    <li @if(request()->route()->getName() == 'admin.account-management' || request()->route()->getName() == 'admin.change-password') class="active" @endif>
                        <a href="javascript:void(0)" title="Quản lý tài khoản" class="menu__link">
                            <span class="menu__icon">
                                <img src="{{ __BASE_URL__ }}/images/admin/icon__user.png" alt="icon__user.png">
                            </span>
                            <span class="menu__name">
                                Quản lý tài khoản
                            </span>
                        </a>

                        <ul class="menu__sub">
                            <li>
                                <a href="{{route('admin.account-management')}}" title="Thông tin cá nhân">
                                    Thông tin cá nhân
                                </a>
                            </li>

                            <li>
                                <a href="{{route('admin.change-password')}}" title="Đổi mật khẩu">
                                    Đổi mật khẩu
                                </a>
                            </li>

                        </ul>

                    </li>
                    <li class="">
                        <a href="index.html" title="Đăng xuất" class="menu__link">
                            <span class="menu__icon">
                                <img src="{{ __BASE_URL__ }}/images/admin/icon__logout.png" alt="icon__logout.png">
                            </span>
                            <span class="menu__name">
                                Đăng xuất
                            </span>
                        </a>

                    </li>

                </ul>
            </div>
        </div>
        @yield('main-admin')
        <script type="text/javascript" src="{{ __BASE_URL__ }}/js/admin-tool.js"></script>
        <script type="text/javascript" src="{{ __BASE_URL__ }}/js/admin-main.js"></script>
        <script type="text/javascript" src="{{ __BASE_URL__ }}/js/toastr.min.js"></script>
        <script type="text/javascript">
			$(document).ready(function(){
				toastr.options = {
					"closeButton": false,
					"debug": false,
					"newestOnTop": false,
					"progressBar": false,
					"positionClass": "toast-top-right",
					"preventDuplicates": false,
					"onclick": null,
					"showDuration": "300",
					"hideDuration": "1000",
					"timeOut": "5000",
					"extendedTimeOut": "1000",
					"showEasing": "swing",
					"hideEasing": "linear",
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut"
				}
				var url = '{{url()->current()}}';
			    var parent_id = $('a[href="'+url+'"]').data('parent');
			    $('li[data-id="'+parent_id+'"]').addClass('active');
			});
		</script>
        @yield('scrip-admin')
    </div>
</body>

</html>