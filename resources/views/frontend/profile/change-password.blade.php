@section('admin-css')
<link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/admins/admin-change-password.css" />
<link rel="stylesheet" type="text/css" href="{{ __BASE_URL__ }}/css/toastr.min.css" />
@stop
@extends('frontend.profile.general')
@section('main-admin')
    <style>
        .fr-error{
            color: red;
        }
    </style>
    <main id="main">
        @include('frontend.profile.main-admin-header')
        <form action="{{route('admin.post-change-password')}}" method="POST">
            @csrf
            <div class="card change__card">
                <h1 class="title__global">Đổi mật khẩu</h1>
                <div class="change__row">
                    <div class="change__col">
                        <label for="" class="name__global">Mật khẩu hiện tại</label>
                        <div class="change__group">
                            <input type="password" placeholder="Mật khẩu hiện tại" value="{!! old('current_password') !!}"  name="current_password" />
                            <button type="button" class="btn change__icon">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                            @if($errors->has('current_password'))
                                <span class="fr-error">{{ $errors->first('current_password') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="change__col">
                        <label for="" class="name__global">Mật khẩu mới</label>
                        <div class="change__group">
                            <input type="password" placeholder="Mật khẩu mới" value="{!! old('new_password') !!}" name="new_password" />
                            <button type="button" class="btn change__icon">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                            @if($errors->has('new_password'))
                                <span class="fr-error">{{ $errors->first('new_password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="change__col">
                        <label for="" class="name__global">Nhập lại mật khẩu</label>
                        <div class="change__group">
                            <input type="password" placeholder="Nhập lại mật khẩu" name="confirm" value="{!! old('confirm') !!}" />
                            <button type="button" class="btn change__icon">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                            @if($errors->has('confirm'))
                                <span class="fr-error">{{ $errors->first('confirm') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="control__group">
                <button class="btn btn__save">Lưu</button>
                <a href="{{route('admin.account-management')}}"><button type="button" class="btn btn__cancel" style="width:100%">Huỷ</button></a>
            </div>
        </form>

    </main>

@section('scrip-admin')
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/toastr.min.js"></script>
    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            
            showPassword = () => {
                let isPass = false;
                $(".change__icon").on("click", function() {
                    if (isPass) {
                        $(this)
                            .parent(".change__group")
                            .children("input")
                            .attr("type", "password");
                        $(this).html(
                            '<i class="fa fa-eye" aria-hidden="true"></i>'
                        );
                        isPass = false;
                    } else {
                        $(this)
                            .parent(".change__group")
                            .children("input")
                            .attr("type", "text");
                        $(this).html(
                            '<i class="fa fa-eye-slash" aria-hidden="true"></i>'
                        );
                        isPass = true;
                    }
                    console.log(isPass);
                });
            };
            showPassword();

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

            const base_url = '{{url('/')}}';

        });
    </script>
    @if (Session::has('toastr'))

    <script>

        jQuery(document).ready(function($) {

            toastr["success"]('{{ Session::get('toastr') }}', 'Thông báo');

        });

    </script>

    @endif
    @endsection
@stop