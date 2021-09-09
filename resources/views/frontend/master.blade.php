<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="{{ url('/').$site_info->favicon }}">
		@if (isset($site_info->index_google))
			<meta name="robots" content="{{ $site_info->index_google == 1 ? 'index, follow' : 'noindex, nofollow' }}">
		@else
			<meta name="robots" content="noindex, nofollow">
		@endif
		{!! SEO::generate() !!}
		<meta name='revisit-after' content='1 days' />
		<meta name="copyright" content="GCO" />
		<meta http-equiv="content-language" content="vi" />
		<meta name="geo.region" content="VN" />
	    <meta name="geo.position" content="10.764338, 106.69208" />
	    <meta name="geo.placename" content="Hà Nội" />
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
	 	<meta name="_token" content="{{csrf_token()}}" />
	 	<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	 	<link rel="canonical" href="{{ \Request::fullUrl() }}">
		 <!--link css-->
		 <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/tool.css">
		<link rel="stylesheet" href="{{ __BASE_URL__ }}/css/main.css" />
        <link rel="stylesheet" type="text/css" href="{{ __BASE_URL__ }}/css/toastr.min.css" />
		<link rel="stylesheet" type="text/css" href="{{ __BASE_URL__ }}/css/tdt.css" />
		<link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
		@yield('css')
	 	@if (!empty($site_info->ticktok))
		<!-- Ticktok -->
			<script>
				(function() {
					var ta = document.createElement('script'); ta.type = 'text/javascript'; ta.async = true;
					ta.src = 'https://analytics.tiktok.com/i18n/pixel/sdk.js?sdkid={{ $site_info->ticktok }}';
					var s = document.getElementsByTagName('script')[0];
					s.parentNode.insertBefore(ta, s);
				})();
			</script>
		@endif

		@if (!empty($site_info->google_analytics))
		<!-- Google Analysis -->
			<script>
				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
				ga('create', '{{ $site_info->google_analytics }}', 'auto');
				ga('send', 'pageview');
			</script>
		@endif

		@if (!empty($site_info->google_tag_manager))
		<!-- Google Tag Manager -->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,'script','dataLayer','{{ $site_info->google_tag_manager }}');</script>
		@endif
		
	</head> 
	<body class="page-body home-body">

		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ @$site_info->google_tag_manager }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

		@if (!empty($site_info->facebook_pixel))
		<!-- Facebook Pixel -->
			<script>
				!function(f,b,e,v,n,t,s)
				{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
				n.callMethod.apply(n,arguments):n.queue.push(arguments)};
				if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
				n.queue=[];t=b.createElement(e);t.async=!0;
				t.src=v;s=b.getElementsByTagName(e)[0];
				s.parentNode.insertBefore(t,s)}(window, document,'script',
				'https://connect.facebook.net/en_US/fbevents.js');
				fbq('init', '{{ $site_info->facebook_pixel }}');
				fbq('track', 'PageView');
		  </script>
		@endif

		<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ @$site_info->facebook_pixel }}&ev=PageView&noscript=1"/></noscript>

		@if (!empty($site_info->facebook_chat))
			<!-- Load Facebook SDK for JavaScript -->
			<div id="fb-root"></div>
			<script>
			window.fbAsyncInit = function() {
				FB.init({
				xfbml            : true,
				version          : 'v8.0'
				});
			};

			(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>

			<div class="fb-customerchat" attribution=setup_tool page_id="{{@$site_info->facebook_chat}}" logged_in_greeting="{{trans('message.xin_chao_chung_toi_co_the_giup_gi_cho_ban')}}" logged_out_greeting="{{trans('message.xin_chao_chung_toi_co_the_giup_gi_cho_ban')}}">
	    </div>
		@endif
			<input type="hidden" name="base_url" value="{{url('/')}}">
			<div class="loadingcover" style="display: none;">
				<p class="csslder">
					<span class="csswrap">
						<span class="cssdot"></span>
						<span class="cssdot"></span>
						<span class="cssdot"></span>
					</span>
				</p>
			</div>

			@include('frontend.teamplate.header')
			@yield('main')
			@include('frontend.teamplate.footer')

			<button class="btn btn__backtop-home"></button>

			<script type="text/javascript" src="{{ __BASE_URL__ }}/js/tool.js"></script>

			<script type="text/javascript" src="{{ __BASE_URL__ }}/js/main.js"></script>

			<script type="text/javascript" src="{{ __BASE_URL__ }}/js/toastr.min.js"></script>

			<script type="text/javascript" src="{{ __BASE_URL__ }}/js/custom.js"></script>
        
		@yield('script')

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


		@if (Session::has('toastr'))

			<script>

				jQuery(document).ready(function($) {

					toastr["success"]('{{ Session::get('toastr') }}', 'Thông báo');

				});

			</script>

		@endif

		@if (Session::has('toastr_err'))

			<script>

				jQuery(document).ready(function($) {

					toastr["error"]('{{ Session::get('toastr_err') }}', 'Thông báo');

				});

			</script>

		@endif
		
		@if (!empty($site_info->script))
			{!! $site_info->script !!}
		@endif

		
	    <!-- Your Chat Plugin code -->
	</body>
</html>