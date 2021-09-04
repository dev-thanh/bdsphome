<?php $curent_page = request()->get('page') ? request()->get('page') : '1'; ?>
@extends('frontend.master')
@section('main')
	
	<main id="main" class="main-category">
		@if(isset($category))
			<?php $banner = json_decode($category->meta_banner); ?>
			@if(!empty(@$banner->image))
		    <section class="category__banner">
		        <img class="category__banner--img" src="{{@$banner->image}}" alt="{{@$banner->title}}">
		        <h2 class="category__banner--title">
		            {{@$banner->title}}
		        </h2>
		    </section>
		    @endif
	    @endif
	    <section class="page__category">
	        <div class="container">
	            <div class="module module-page__categroy">
	                <div class="module__content">
	                    <div class="page__category-group">
	                        @include('frontend.teamplate.category-sidebar')
	                        <div class="page__category-item page__category-main">
	                        	<div class="filter__top">
                                    <span class="filter__name">
                                    Sắp xếp theo:
                                    </span>
                                    <div class="filter__group">
                                        <label for="raido__1" class="filter__top-item">
                                        <input type="radio" name="filer__raido" class="filter__top-radio" id="raido__1" value="1">
                                        <span>
                                        Giá từ thấp đến cao
                                        </span>
                                        </label>
                                        <label for="raido__2" class="filter__top-item">
                                        <input type="radio" name="filer__raido" class="filter__top-radio" id="raido__2" value="2">
                                        <span>
                                        Giá từ cao đến thấp
                                        </span>
                                        </label>
                                        <label class="filter__top-item" for="raido__3">
                                        <input type="radio" name="filer__raido" class="filter__top-radio" id="raido__3" value="3">
                                        <span>
                                        Sản phẩm khuyến mại
                                        </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="page__category-main-load">
		                            <div class="page__product-group">
		                            	@foreach($data as $item)
		                                <div class="product">
		                                    <div class="box">
		                                        <a href="{{route('home.single.product',['slug'=>$item->slug])}}" class="avata" title="{{$item->name}}">
		                                        <img class="avata__image" src="{{url('/')}}/{{$item->image}}" alt="{{$item->name}}">
		                                        </a>
		                                        <div class="product__content">
		                                            <h3 class="product__title">
		                                                <a href="{{route('home.single.product',['slug'=>$item->slug])}}" class="product__link" title="{{$item->name}}">
		                                                 	{{$item->name}}
		                                                </a>
		                                            </h3>
		                                            <div class="product__cost">
		                                            	@if ($item->regular_price != 0)
					                                        @if($item->sale_price !='')
				                                                <span class="text__through">{{ number_format($item->regular_price,0, '.', '.') }}đ</span>
						                                        <span class="price__red">
						                                        {{ number_format($item->sale_price,0, '.', '.') }}đ
						                                        </span>
					                                        @else
					                                        	<span class="price__red">{{ number_format($item->regular_price,0, '.', '.') }}đ</span>
					                                        @endif
		                                            	@else
		                                            		<span class="price__red">Liên hệ</span>
				                                        @endif
		                                            </div>
		                                            <div class="text__right">
		                                                <a href="{{route('home.single.product',['slug'=>$item->slug])}}" class="link__view" title="Xem chi tiết">
		                                                Xem chi tiết
		                                                </a>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                                @endforeach
		                            </div>
		                            <div class="text__right">
		                                <ul class="pagination">
		                                    <li class="prev"><a href="{{url()->current()}}?page={{$curent_page-1}}" @if($curent_page==1) onclick="return false;" @endif"><span>&#10140;</span></a></li>

		                                    @for($i = 0; $i < $data->lastpage(); $i++)
		                                    <li class="" data-page="{{$i+1}}">
		                                    	<a href="{{url()->current()}}?page={{$i+1}}" @if($curent_page == $i+1) onclick="return false;" @endif">{{$i+1}}</a>
		                                    </li>
		                                    @endfor
		                                    
		                                    <li class="next"><a href="{{url()->current()}}?page={{$curent_page+1}}" @if($curent_page==$data->lastpage()) onclick="return false;" @endif><span>&#10140;</span></a></li>
		                                </ul>
		                            </div>
                                </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>
	</main>
	@section('script')
	<script>

        jQuery(document).ready(function($) {

            $('[data-page="{{$curent_page}}"]').addClass('active');

        });



    </script>
    @endsection
@endsection