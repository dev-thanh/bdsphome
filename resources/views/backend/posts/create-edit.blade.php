@extends('backend.layouts.app')
@section('controller', $module['name'] )
@section('controller_route', route($module['module'].'.index'))
@section('action', renderAction(@$module['action']))
@section('content')
	<div class="content">
		<div class="clearfix"></div>
       	@include('flash::message')
       	<form action="{!! updateOrStoreRouteRender( @$module['action'], $module['module'], @$data) !!}" method="POST">
			@csrf
			@if(isUpdate(@$module['action']))
		        {{ method_field('put') }}
		    @endif
			<div class="row">
                <div class="col-sm-9">
					<div class="nav-tabs-custom">
		                <ul class="nav nav-tabs">
		                    <li class="active">
		                        <a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin tin tức</a>
		                    </li>
							
							<li class="">
		                    	<a href="#setting" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>
		                    </li>
		                </ul>
		                <div class="tab-content">

		                    <div class="tab-pane active" id="activity">
		                    	<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
		                                    <label>Tiêu đề tin tức</label>
		                                    <input type="text" class="form-control" name="name" id="name" value="{!! old('name', @$data->name) !!}">
		                                </div>
									</div>
									
		                    		<div class="col-sm-12">
		                                @if(isUpdate(@$module['action']))
			                                <div class="form-group" id="edit-slug-box">
			                                    @include('backend.posts.permalink')
			                                </div>
		                                @endif
                                    </div>
                                   
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Mô tả ngắn tin tức</label>
                                            <textarea class="form-control" name="desc" style="min-height: 100px">{!! old('desc', @$data->desc) !!}</textarea>
                                        </div>
									</div>
									
                                    <div class="col-sm-12">
                                        <div class="form-group">
		                                	<label for="">Nội dung tin tức</label>
		                                	<textarea class="content" name="content">{!! old('content', @$data->content) !!}</textarea>
                                        </div>
									</div>
									
		                    	</div>
							</div>
							

							<div class="tab-pane" id="setting">
		                    	<div class="form-group">
			                        <label>Title SEO</label>
			                        <label style="float: right;">Số ký tự đã dùng: <span id="countTitle">{{ @$data->meta_title != null ? mb_strlen( $data->meta_title, 'UTF-8') : 0 }}/70</span></label>
			                        <input type="text" class="form-control" name="meta_title" value="{!! old('meta_title', isset($data->meta_title) ? $data->meta_title : null) !!}" id="meta_title">
			                    </div>

			                    <div class="form-group">
			                        <label>Meta Description</label>
			                        <label style="float: right;">Số ký tự đã dùng: <span id="countMeta">{{ @$data->meta_description != null ? mb_strlen( $data->meta_description, 'UTF-8') : 0 }}/360</span></label>
			                        <textarea name="meta_description" class="form-control" id="meta_description" rows="3">{!! old('meta_description', isset($data->meta_description) ? $data->meta_description : null) !!}</textarea>
			                    </div>

			                    <div class="form-group">
			                        <label>Meta Keyword</label>
			                        <input type="text" class="form-control" name="meta_keyword" value="{!! old('meta_keyword', isset($data->meta_keyword) ? $data->meta_keyword : null) !!}">
			                    </div>
			                    @if(isUpdate(@$module['action']))
				                    <h4 class="ui-heading">Xem trước kết quả tìm kiếm</h4>
				                    <div class="google-preview">
				                        <span class="google__title"><span>{!! !empty($data->meta_title) ? $data->meta_title : @$data->name !!}</span></span>
				                        <div class="google__url">
				                            {{ asset( 'products/'.$data->slug ) }}
				                        </div>
				                        <div class="google__description">{!! old('meta_description', isset($data->meta_description) ? @$data->meta_description : '') !!}</div>
				                    </div>
			                    @endif
		                    </div>
		                </div>
		            </div>
				</div>
				<div class="col-sm-3">
					<div class="box box-success">
		                <div class="box-header with-border">
		                    <h3 class="box-title">Đăng tin tức</h3>
		                </div>
		                <div class="box-body">
		                    <div class="form-group">
                                <label class="custom-checkbox">
		                        	@if(isUpdate(@$module['action']))
		                            	<input type="checkbox" name="status" value="1" {{ @$data->status == 1 ? 'checked' : null }}> Hiển thị
		                            	<br>
		                            	<input type="checkbox" name="hot" value="1" {{ @$data->hot == 1 ? 'checked' : null }}> Hiển thị ngoài trang chủ
		                            @else
		                            	<input type="checkbox" name="status" value="1" checked> Hiển thị
		                            	<br>
		                            	<input type="checkbox" name="hot" value="1" checked> Hiển thị ngoài trang chủ
		                            @endif
		                        </label>
							</div>
							
		                    <div class="form-group text-right">
		                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại tin tức</button>
		                    </div>
		                </div>
					</div>
                    <div class="box box-success">
                        <div class="box-header with-border">
		                    <h3 class="box-title">Danh mục tin tức</h3>
		                </div>
		                <div class="box-body checkboxlist">
                           	@if(@$module['action'] =='update')
			                    <?php  
					      			if(old('category')){
					      				$value = old('category');
					      			}else{
					      				$value  = $array_id;
					      			}
					      			menuMultiEditPost($categories,0,$str='',$value);
					      		?>
                           	@else
                           		<?php menuMultiEditPost($categories,0,$str='',old('category')); ?>
		                    @endif
		                </div>
		            </div>
		            <div class="box box-success">
		                <div class="box-header with-border">
		                    <h3 class="box-title">Ảnh tin tức</h3>
		                </div>
		                <div class="box-body">
		                    <div class="form-group" style="text-align: center;">
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
		            </div>
				</div>
			</div>
		</form>
	</div>

@stop

@section('scripts')
	<script>
		jQuery(document).ready(function($) {
			$('#btn-ok').click(function(event) {
		        var slug_new = $('#new-post-slug').val();
		        var name = $('#name').val();
		        $.ajax({
		        	url: '{{ route($module['module'].'.get-slug') }}',
		        	type: 'GET',
		        	data: {
		        		id: $('#idPost').val(),
		        		slug : slug_new.length > 0 ? slug_new : name,
		        		type : 'slug'
		        	},
		        })
		        .done(function(data) {
		        	$('#change_slug').show();
			        $('#btn-ok').hide();
			        $('.cancel.button-link').hide();
			        $('#current-slug').val(data);
		        	cancelInput(data);
		        })
		    });
		});
		jQuery(document).ready(function($) {
			$('#btn-ok-en').click(function(event) {
		        var slug_new = $('#new-post-slug-en').val();
		        var name = $('#name-en').val();
		        $.ajax({
		        	url: '{{ route($module['module'].'.get-slug') }}',
		        	type: 'GET',
		        	data: {
		        		id: $('#idPost-en').val(),
		        		slug : slug_new.length > 0 ? slug_new : name,
		        		type : 'slug_en'
		        	},
		        })
		        .done(function(data) {
		        	$('#change_slug-en').show();
			        $('#btn-ok-en').hide();
			        $('.button-link-en').hide();
			        $('#current-slug-en').val(data);
		        	cancelInput_en(data);
		        })
		    });
		});
	</script>
	
@endsection

@section('css')
	<link rel="stylesheet" href="{{ url('public/backend/plugins/datetimepicker/bootstrap-timepicker.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
@endsection

