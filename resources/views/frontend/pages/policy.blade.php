@extends('frontend.master')
@section('main')

	<?php if(!empty($contentHome)){
		$content = json_decode($contentHome->content);
	} ?>

	<main	main id="main">
		<div class="container">
			<ul class="breadcrumb__global">
				<li>
					<a href="{{route('home.index')}}" title="trang chủ"> Trang chủ </a>
				</li>
				<li>
					<a title="{{@$data->name}}"> {{@$data->name}}  </a>
				</li>
			</ul>
		</div>
		<section class="page__rules">
			<div class="module moduel-page__rules">
				<div class="container">
					<div class="col-12 col-xl-7 p-0">
						<h1 class="rules__title">
							{{@$data->name}}
						</h1>
						<div class="rules__content">
							{!! @$data->content !!}
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
@endsection