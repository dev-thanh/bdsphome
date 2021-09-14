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
						<input type="hidden" name="active_tab" id="active_tab" value="">
		                <ul class="nav nav-tabs">

		                    <li class="@if(!session('active_tab') || session('active_tab')=='' || session('thong-tin')) active @endif" data-tab="thong-tin">

		                        <a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin</a>

		                    </li>

		                    <li @if(session('active_tab')=='thuoc-tinh') class="active" @endif data-tab="thuoc-tinh">

		                    	<a href="#attributes" data-toggle="tab" aria-expanded="true">Nội dung chi tiết dự án</a>

		                    </li>

		                    <li  @if(session('active_tab')=='thu-vien-anh') class="active" @endif data-tab="thu-vien-anh">

		                    	<a href="#gallery" data-toggle="tab" aria-expanded="true">Thư viện ảnh</a>

		                    </li>

		                    <li  @if(session('active_tab')=='cau-hinh-seo') class="active" @endif data-tab="cau-hinh-seo">

		                    	<a href="#setting" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>

		                    </li>


		                </ul>

		                <div class="tab-content">



		                    <div class="tab-pane  @if(!session('active_tab') || session('active_tab')=='' || session('active_tab')=='thong-tin') active @endif" id="activity">

		                    	<div class="row">

		                    		<div class="col-sm-12">



		                    			<div class="form-group">

				                    		<label for="">Tên dự án</label>

				                    		<input type="text" name="name" id="name" class="form-control" value="{{ old('name', @$data->name) }}">

				                    	</div>
										<div class="form-group">

											<label for="">Địa chỉ</label>

											<input type="text" name="address" class="form-control" value="{{ old('address', @$data->address) }}">

										</div>

										@if(isUpdate(@$module['action']))

			                                <div class="form-group" id="edit-slug-box">

			                                    @include('backend.projects.permalink')

			                                </div>

		                                @endif



		                    		</div>



		                    		<div class="col-sm-12">

										<div class="form-group">

				                    		<label for="">Giá bán(tổng thể)</label>

				                    		<input type="text" name="price" class="form-control" 

				                    		value="{{ old('price', @$data->price) }}">

				                    	</div>

		                    			<div class="form-group">

				                    		<label for="">Giá bán(m2)</label>

				                    		<input type="text" name="price2" class="form-control" 

				                    		value="{{ old('price2', @$data->price2) }}">

				                    	</div>

		                    		</div>

		                    		<div class="col-sm-12">

		                    			<div class="form-group">

				                    		<label for="">Chủ đầu tư dự án</label>

				                    		<select name="company_id" class="form-control multislt">

				                    			<option value="">---Chọn chủ đầu tư---</option>

				                    			@foreach (@$company as $item)
													@php 
														$company_id = @$data->company_id;
														if(old('company_id')){$company_id=old('company_id');}
													@endphp
				                    				<option value="{{ $item->id }}" {{ $item->id == @$company_id ? 'selected' : null }} >

				                    					{{ $item->name }}

				                    				</option>

				                    			@endforeach

				                    		</select>

				                    	</div>

		                    		</div>

									
		                    		<div class="col-sm-12">

		                    			<div class="form-group">

		                    				<label class="title-cd">Mô tả thông số dự án</label>
		                    				<div class="repeater" id="repeater">
												<table class="table table-bordered table-hover color">
													<thead>
														<tr>
															<th style="width: 30px;">STT</th>
															<th>Tiêu đề</th>
															<th>Giá trị</th>
															<th style="width: 20px;"></th>
														</tr>
													</thead>
													<?php if(!empty($data->desc)){
														$descs = json_decode($data->desc);
													} ?>
													<tbody id="sortable">
														@if(old('desc'))
															<?php $descs = json_decode(json_encode(old('desc'))); ?>
														@endif
														@if (!empty(@$descs))
															@foreach ($descs as $id => $value)
																<?php $index = $loop->index + 1 ?>
																@include('backend.repeater.row-color')
															@endforeach
														@endif
													</tbody>
												</table>
												<div class="text-right">
													<button class="btn btn-primary" 
														onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'color', '.color')">Thêm
													</button>
												</div>
											</div>
		                    			</div>
		                    		</div>

		                    		<div class="col-sm-12">

		                    			<div class="form-group">

		                    				<label for="">Mô tả ngắn</label>

		                    				<textarea class="form-control" rows="5" name="sort_desc">{{ old('sort_desc', @$data->sort_desc) }}</textarea>

		                    			</div>

		                    		</div>
		                    	</div>

		                    </div>



		                    <div class="tab-pane @if(session('active_tab')=='thu-vien-anh') active @endif" id="gallery">

		                    	<div class="row">

			                        <div class="col-sm-12 image">

			                        	<label for="">Hình ảnh chi tiết dự án</label><br>

			                            <button type="button" class="btn btn-success" onclick="fileMultiSelect(this)"><i class="fa fa-upload"></i>  

			                                Chọn hình ảnh

			                            </button>

			                            <br><br>

			                            <div class="image__gallery">

			                            	@if (!empty($data->more_image))

			                            		<?php $more_image = json_decode($data->more_image) ?>

			                            		@foreach ($more_image as $item)

			                            			<div class="image__thumbnail image__thumbnail--style-1">

			                            				<img src="{{ @$item }}">

			                            				<a href="javascript:void(0)" class="image__delete" onclick="urlFileMultiDelete(this)">

			                            					<i class="fa fa-times"></i>

			                            			    </a>

			                            				<input type="hidden" name="gallery[]" value="{{ @$item }}">

			                            			</div>

			                            		@endforeach

			                            	@endif

			                            </div>

			                        </div>

			                    </div>

		                    </div>

		                    <div class="tab-pane @if(session('active_tab')=='thuoc-tinh') active @endif" id="attributes">

		                    	<div class="row">

									<div class="repeater col-sm-12" id="repeater">
										<div class="form-group">
											<h4 class="text-center">Nội dung chi tiết dự án</h4>
										</div>
										<table class="table table-bordered table-hover tab_content">
											<?php if(!empty($data->content)){
												$contents = json_decode($data->content);
											} ?>
											<tbody id="sortable">
												@if(old('content'))
														<?php $contents = json_decode(json_encode(old('content'))); ?>
												@endif
												@if(@$contents)
													@foreach ($contents as $key => $content)
														
														@if(!empty($content->tab_content))
															<?php $value = $content->tab_content; ?>
															<?php $index = $loop->index + 1; ?>
															@include('backend.repeater.row-tab_content')
														@endif
														@if(!empty($content->slide))
														<?php $value = $content->slide; ?>
															<?php $index = $loop->index + 1; ?>
															@include('backend.repeater.row-tab_slide')
														@endif
														
													@endforeach
												@else
													
												@endif
											</tbody>
										</table>
										<div class="text-right col-sm-12" style="margin-bottom: 30px">
											<button class="btn btn-success" 
												onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'tab_content', '.tab_content')">Thêm tab nội dung
											</button>
											<button class="btn btn-success" 
												onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'tab_slide', '.tab_slide')">Thêm tab slide ảnh
											</button>
										</div>
									</div>

		                    	</div>

		                    </div>

		                    
		                    <div class="tab-pane @if(session('active_tab')=='cau-hinh-seo') active @endif" id="setting">

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

				                            {{ asset( 'san-pham/'.$data->slug.'-'.$data->id ) }}

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

		                    <h3 class="box-title">Đăng dự án</h3>

		                </div>

		                <div class="box-body">

		                    <div class="form-group">

		                        <label class="custom-checkbox">

		                        	@if(isUpdate(@$module['action']))

		                            	<input type="checkbox" name="status" value="1" {{ @$data->status == 1 ? 'checked' : null }}> Hiển thị

		                            @else

		                            	<input type="checkbox" name="status" value="1" checked> Hiển thị

		                            @endif

		                        </label>

								<label class="custom-checkbox">

									@if(isUpdate(@$module['action']))

		                            	<input type="checkbox" name="hot" value="1" {{ @$data->hot == 1 ? 'checked' : null }}> Nổi bật

		                            @else

		                            	<input type="checkbox" name="hot" value="1"> Nổi bật

		                            @endif

		                        </label>

		                        </label>

		                    </div>

		                    <div class="form-group text-right">

		                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại dự án</button>

		                    </div>

		                </div>

		            </div>

		            <div class="box box-success category-box">

		                <div class="box-header with-border">

		                    <h3 class="box-title">Danh mục dự án </h3>

		                </div>

		                <div class="box-body checkboxlist">

		                	<?php 

		                        $category_list = [];

		                        if(!empty(@$data->category)){

		                           $category_list = @$data->category->pluck('id')->toArray();

		                        }

		                    ?>

		                    @if (!empty($categories))

		                        @foreach ($categories as $item)

		                            @if ($item->parent_id == 0)

		                                <label class="custom-checkbox">

		                                    <input type="checkbox" class="category" name="category[]" value="{{ $item->id }}" {{ in_array( $item->id, $category_list ) ? 'checked' : null }}> {{ $item->name }}

		                                 </label>

		                                 <?php checkBoxCategory( $categories, $item->id, $item, $category_list ) ?>

		                            @endif

		                        @endforeach

		                    @endif

		                </div>

		            </div>

		            <div class="box box-success">

		                <div class="box-header with-border">

		                    <h3 class="box-title">Ảnh dự án</h3>

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

	<script src="{{ url('public/backend/cus/select.option.js') }}"></script>
	<script src="{{ url('public/backend/plugins/datetimepicker/bootstrap-datepicker.min.js') }}"></script>

	

	<script>

		$(document).on('ready', function() {

		    $('.multislt').select2({

		        placeholder: "Chọn thương hiệu",

		    });

			$(document).on('click','.buttonremovetable',function(){
				$(this).parents('tr').remove();
            });

		});

	</script>

	<script>

		jQuery(document).ready(function($) {

			$('#btn-ok').click(function(event) {

		        var slug_new = $('#new-post-slug').val();

		        var name = $('#name').val();

		        $.ajax({

		        	url: '{{ route('projects.get-slug') }}',

		        	type: 'GET',

		        	data: {

		        		id: $('#idPost').val(),

		        		slug : slug_new.length > 0 ? slug_new : name,

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

	</script>



	<script>

		jQuery(document).ready(function($) {

			$('.datepicker').datepicker({

				format: 'dd/mm/yyyy',

		      	autoclose: true

		    });

		});	

	</script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>

	<script src="{{ url('public/backend/plugins/taginput/bootstrap-tagsinput.min.js') }}"></script>

	<script>

		jQuery(document).ready(function($) {

			$('input[name="time_published"]').click(function(){

			   	if($(this).val() == 2){

			   		$('.time_published_value').show('slow/400/fast');

			   	}else{

			   		$('.time_published_value').hide('slow/400/fast');

			   	}

			});

			$('#tags-input').tagsinput({

			  	

			});

		    $('#reservation').on('apply.daterangepicker', function(ev, picker) {

		        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));

		    });



		    $('#reservation').on('cancel.daterangepicker', function(ev, picker) {

		        $(this).val('');

		    });

			

		    <?php 

		    	$time_priority = old("time_priority", @$data->time_priority)



		    ?>

			$('.nav-tabs-custom li').on('click',function(){
				console.log(22);
				var tab_name = $(this).data('tab');
				$('#active_tab').val(tab_name);
			})



			

		});

	</script>

@endsection



@section('css')

	<link rel="stylesheet" href="{{ url('public/backend/plugins/datetimepicker/bootstrap-timepicker.css') }}">

	<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="{{ url('public/backend/plugins/taginput/bootstrap-tagsinput.css') }}">

@endsection