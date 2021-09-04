@extends('frontend.master')
@section('main')
	<?php 
		if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
		//dd($content);
	} ?>
	<main id="main" class="main-category">
	    <section class="category__banner">
	        <img class="category__banner--img" src="{{url('/')}}/{{@$dataSeo->banner}}" alt="{{@$dataSeo->name_page}}">
	        <h2 class="category__banner--title">
	            {{@$dataSeo->name_page}}
	        </h2>
	    </section>
	    <article class="art-banners art-contact">
	        <div class="container">
	        <div class="row">
	            <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-12">
	                <div class="module module__contact">
	                    <div class="module__header title-box">
	                        <h3 class="title">Liên hệ với chúng tôi qua</h3>
	                    </div>
	                    <div class="module__content">
	                        <div class="address-box">
	                            {!! @$content->meta_description !!}
	                        </div>
	                        <div class="contacts-content">
	                            <div class="module__header title-box">
	                                <h3 class="title">{{@$content->title_header}}</h3>
	                            </div>
	                            <form class="contacts-form" id="frm_contact" action="{{route('home.post-contact')}}" method="POST">
	                            	@csrf
	                                <div class="form-content">
	                                    <div class="form-group">
	                                        <input class="form-control" type="text" name="name" placeholder="Họ và tên">
	                                        <span class="fr-error" id="error_name"></span>
	                                    </div>
	                                    <div class="form-group">
	                                        <input class="form-control" type="text" name="phone"
	                                            placeholder="Số điện thoại">
                                            <span class="fr-error" id="error_phone"></span>
	                                    </div>
	                                    <div class="form-group">
	                                        <textarea class="form-control" type="text" name="content"
	                                            placeholder="Nội dung cần tư vấn" rows="3"></textarea>
	                                            <span class="fr-error" id="error_content"></span>
	                                    </div>
	                                    <div class="form-group">
	                                        <div class="form-button">
	                                            <button class="btn btn-send-contact">Gửi</button>
	                                        </div>
	                                    </div>
	                                </div>
	                            </form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">
	                <div class="module module__map">
	                    <div class="module__content">
	                        {!! @$content->code_google_map !!}
	                    </div>
	                </div>
	            </div>
	        </div>
	    </article>
	</main>

@endsection