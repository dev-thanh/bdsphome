@extends('backend.layouts.app')
@section('controller', 'Loại nhà đất' )
@section('controller_route', route('categories-nd.index'))
@section('action', renderAction(@$module['action']))
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<form action="{!! updateOrStoreRouteRender( @$module['action'], $module['module'], @$data) !!}" method="POST">
					@csrf
					@if(isUpdate(@$module['action']))
				        {{ method_field('put') }}
				    @endif
				    <div class="nav-tabs-custom">
		                <ul class="nav nav-tabs">
		                    <li class="active">
		                        <a href="#activity" data-toggle="tab" aria-expanded="true">Loại nhà đất</a>
		                    </li>
							<li class="">
		                        <a href="#activity2" data-toggle="tab" aria-expanded="true">Cài đặt hiển thị</a>
		                    </li>
		                    <li class="">
		                    	<a href="#setting" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>
		                    </li>
		                </ul>
		                <div class="tab-content">
		                    <div class="tab-pane active" id="activity">
								<div class="form-group">
									<label for="">Tên danh mục</label>
									<input type="text" class="form-control" name="name" id="name" value="{{ old('name', @$data->name) }}">
								</div>
								
								<div class="form-group">
									<label for="">Đường dẫn tĩnh</label>
									<input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug', @$data->slug) }}">
								</div>
								
								<!-- <div class="form-group">
									<label for="">Danh mục cha</label>
									<select name="parent_id" class="form-control">
										<option value="0">Danh mục cha</option>
										   <?php menuMulti( $categories , 0 , '' ,   old( 'parent_id', @$data->parent_id )); ?>
									</select>
								</div> -->
								<!-- <div class="form-group">
									<label for="">Mô tả</label>
									<textarea name="content" class="content">{!! old('content', @$data->content) !!}</textarea>
								</div> -->

		                    </div>

							<div class="tab-pane" id="activity2">
								@php 
									if(!empty($data->content)){
										$contents = json_decode($data->content);
									}
									if(old('content')){
										$contents = json_decode(json_encode(old('content')));
									}
								@endphp
								<div class="col-sm-6">
									<div class="form-group">
										<input type="checkbox" name="content[show_bedroom]" value="1" @if( @$contents->show_bedroom)==1) checked @endif>
										<label for="">Số phòng ngủ</label>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<input type="checkbox" name="content[show_bathroom]" value="1" @if( @$contents->show_bathroom==1) checked @endif>
										<label for="">Số phòng tắm,nhà vệ sinh</label>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<input type="checkbox" name="content[show_floors]" value="1" @if( @$contents->show_floors==1) checked @endif>
										<label for="">Số tầng</label>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<input type="checkbox" name="content[direction_house]" value="1" @if( @$contents->direction_house==1) checked @endif>
										<label for="">Giấy tờ pháp lý</label>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<input type="checkbox" name="content[direction_house]" value="1" @if( @$contents->direction_house==1) checked @endif>
										<label for="">Hướng nhà</label>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<input type="checkbox" name="content[balcony_direction]" value="1" @if( @$contents->balcony_direction==1) checked @endif>
										<label for="">Hướng ban công</label>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<input type="checkbox" name="content[frontispiece]" value="1" @if( @$contents->frontispiece==1) checked @endif>
										<label for="">Mặt tiền</label>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<input type="checkbox" name="content[way]" value="1" @if( @$contents->way==1) checked @endif>
										<label for="">Đường rộng</label>
									</div>
								</div>
							</div>
		                    <div class="tab-pane" id="setting">
		                    	<div class="row">
		                    		<div class="col-sm-2">
		                    			<div class="form-group">
		                    				<label for="">Hình ảnh</label>
		                    				 <div class="image">
					                            <div class="image__thumbnail">
					                                <img src="{{ !empty(@$data->image) ? @$data->image : __IMAGE_DEFAULT__ }}"
					                                     data-init="{{ __IMAGE_DEFAULT__ }}">
					                                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
					                                    <i class="fa fa-times"></i></a>
					                                <input type="hidden" value="{{ old('image', @$data->image) }}" name="image"/>
					                                <div class="image__button" onclick="fileSelect(this)">
					                                	<i class="fa fa-upload"></i>
					                                    Upload
					                                </div>
					                            </div>
					                        </div>
		                    			</div>
		                    		</div>
		                    		<div class="col-sm-2">
		                    			<div class="form-group">
		                    				<label for="">Banner</label>
		                    				 <div class="image">
					                            <div class="image__thumbnail">
					                                <img src="{{ !empty(@$data->banner) ? @$data->banner : __IMAGE_DEFAULT__ }}"
					                                     data-init="{{ __IMAGE_DEFAULT__ }}">
					                                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
					                                    <i class="fa fa-times"></i></a>
					                                <input type="hidden" value="{{ old('banner', @$data->banner) }}" name="banner"/>
					                                <div class="image__button" onclick="fileSelect(this)">
					                                	<i class="fa fa-upload"></i>
					                                    Upload
					                                </div>
					                            </div>
					                        </div>
		                    			</div>
		                    		</div>
		                    		<div class="col-sm-8">
		                    			 <div class="form-group">
				                            <label>Title SEO</label>
				                            <input type="text" class="form-control" name="meta_title" value="{!! old('meta_title', @$data->meta_title) !!}">
				                        </div>

				                        <div class="form-group">
				                            <label>Meta Description</label>
				                            <textarea name="meta_description" id="" class="form-control" rows="5">{!! old('meta_description', @$data->meta_description) !!}</textarea>
				                        </div>

				                        <div class="form-group">
				                            <label>Meta Keyword</label>
				                            <input type="text" class="form-control" name="meta_keyword" value="{!! old('meta_keyword', @$data->meta_keyword) !!}">
				                        </div>
		                    		</div>
		                    	</div>
		                    </div>
							<div class="col-sm-12">

								<button type="submit" class="btn btn-primary">Lưu lại</button>
							</div>
		                </div>
		            </div>
				</form>
			</div>
		</div>
	</div>
@stop