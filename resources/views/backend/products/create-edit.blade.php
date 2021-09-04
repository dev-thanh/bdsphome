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

		                    	<a href="#attributes" data-toggle="tab" aria-expanded="true">Thuộc tính</a>

		                    </li>

		                    <li  @if(session('active_tab')=='thu-vien-anh') class="active" @endif data-tab="thu-vien-anh">

		                    	<a href="#gallery" data-toggle="tab" aria-expanded="true">Thư viện ảnh</a>

		                    </li>

							<li  @if(session('active_tab')=='san-pham-ket-hop') class="active" @endif data-tab="san-pham-ket-hop">

								<a href="#spkh" data-toggle="tab" aria-expanded="true">Sản phẩm kết hợp</a>

							</li>

		                    <li  @if(session('active_tab')=='cau-hinh-seo') class="active" @endif data-tab="cau-hinh-seo">

		                    	<a href="#setting" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>

		                    </li>


		                </ul>

		                <div class="tab-content">



		                    <div class="tab-pane  @if(!session('active_tab') || session('active_tab')=='' || session('active_tab')=='thong-tin') active @endif" id="activity">

		                    	<div class="row">

		                    		<?php 

		                    			$sku = old('sku', @$data->sku);

		                    			if(empty($sku)){

		                    				$sku = generateRandomCode();

		                    			}

		                    		?>

		                    		<div class="col-sm-12">

		                    			<div class="form-group">

				                    		<label for="">SKU</label>

				                    		<input type="text" name="sku" class="form-control" value="{{ @$sku }}">

				                    	</div>

		                    		</div>

		                    		<div class="col-sm-12">



		                    			<div class="form-group">

				                    		<label for="">Tên sản phẩm</label>

				                    		<input type="text" name="name" id="name" class="form-control" value="{{ old('name', @$data->name) }}">

				                    	</div>

										

										@if(isUpdate(@$module['action']))

			                                <div class="form-group" id="edit-slug-box">

			                                    @include('backend.products.permalink')

			                                </div>

		                                @endif



		                    		</div>



		                    		<div class="col-sm-12">

		                    			<div class="form-group">

				                    		<label for="">Giá bán</label>

				                    		<input type="number" name="regular_price" class="form-control" 

				                    		value="{{ old('regular_price', @$data->regular_price) }}">

				                    	</div>

		                    		</div>

		                    		<div class="col-sm-12">

		                    			<div class="form-group">

				                    		<label for="">Khuyến mãi % ( Nếu có )</label>

				                    		<input type="number" name="sale_price" class="form-control" 

				                    		value="{{ old('sale_price', @$data->sale_price) }}">

				                    	</div>

		                    		</div>

									<div class="col-sm-12">

		                    			<div class="form-group">

				                    		<label for="">Dung tích sản phẩm(nếu có)</label>

				                    		<input type="text" name="volume" class="form-control" 

				                    		value="{{ old('volume', @$data->volume) }}">

				                    	</div>

		                    		</div>

		                    		<div class="col-sm-12">

		                    			<div class="form-group">

		                    				<label class="title-cd">Màu sắc sản phẩm(nếu có)</label>
		                    				<div class="repeater" id="repeater">
												<table class="table table-bordered table-hover color">
													<thead>
														<tr>
															<th style="width: 30px;">STT</th>
															<th>Tiêu đề màu</th>
															<th>Giá trị</th>
															<th>Bảng màu</th>
															<th style="width: 20px;"></th>
														</tr>
													</thead>
													<tbody id="sortable">
														@if (!empty(@$data->color_content))
															@foreach (json_decode(@$data->color_content) as $id => $value)
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

		                    				<label class="title-cd">Công dụng sản phẩm</label>
		                    				<div class="repeater" id="repeater">
												<table class="table table-bordered table-hover cd">
													<thead>
														<tr>
															<!-- <th style="width: 30px;">STT</th> -->
															<th>Tiêu đề</th>
															<th style="width: 20px;"></th>
														</tr>
													</thead>
													<tbody id="sortable">
														@if (!empty(@$data->cd_content))
															@foreach (json_decode(@$data->cd_content) as $id => $value)
																<?php $index = $loop->index + 1 ?>
																@include('backend.repeater.row-cd')
															@endforeach
														@endif
													</tbody>
												</table>
												<div class="text-right">
													<button class="btn btn-primary" 
														onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'cd', '.cd')">Thêm
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

		                    			<div class="form-group">

		                    				<label for="">Chi tiết</label>

		                    				<textarea class="content" name="content">{!! old('content', @$data->content) !!}</textarea>

		                    			</div>

		                    		</div>
		                    	</div>

		                    </div>



		                    <div class="tab-pane @if(session('active_tab')=='thu-vien-anh') active @endif" id="gallery">

		                    	<div class="row">

			                        <div class="col-sm-12 image">

			                        	<label for="">Hình ảnh chi tiết sản phẩm</label><br>

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
							
							<div class="tab-pane @if(session('active_tab')=='san-pham-ket-hop') active @endif" id="spkh">
								<button type="button" class="btn btn-primary spkh-show">Chọn sản phẩm kết hợp</button>
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<!-- <th style="width: 30px;">STT</th> -->
											<th>Hình ảnh</th>
											<th>Tên sản phẩm</th>
											<th></th>
										</tr>
									</thead>
									<tbody id="sortable" class="spkh-selected">
										@if(isset($spkh))
										@foreach($spkh as $item)
										<tr>
											<td>
												<div class="img-item">
													<img src="{{url('/')}}/{{$item->image}}">
												</div>
											</td>
											<td>
												<div>{{$item->name}}</div>
												<input class="spkh_item" type="hidden" name="spkh_id[]" value="{{$item->id}}">
											</td>
											<td style="text-align: center;">
												<a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
													<i class="fa fa-minus"></i>
												</a>
											</td>
										</tr>
										@endforeach
										@endif
									</tbody>
								</table>
							</div>

		                    <div class="tab-pane @if(session('active_tab')=='thuoc-tinh') active @endif" id="attributes">

		                    	<div class="row">

					                <div class="col-sm-12">

										<div class="repeater" id="repeater">

							                 <table class="table table-bordered table-hover">

							                    <thead>

								                    <tr>

								                    	<th style="width: 30px;">STT</th>

								                    	<th>Loại thuộc tính</th>

								                    	<th>Giá trị</th>

								                    	<th style="width: 30px;"></th>

								                    </tr>

							                	</thead>

							                    <tbody id="sortable">

							                    	<?php $productAttributes = @$data->ProductAttributes ?>

							                    	@if (!empty($productAttributes))

							                    		@foreach ($productAttributes as $attribute)

							                    			<tr>

																<td class="index">{{ $loop->index + 1 }}</td>

																<?php $product_attribute_types = \App\Models\ProductAttributeTypes::all(); ?>

																<td>

																	<select name="product_attributes[{{ $loop->index + 1 }}][id_product_attribute_types]" class="form-control">

																		@foreach ($product_attribute_types as $item)

																			<option value="{{ $item->id }}" 

																				{{ $attribute->id_product_attribute_types == $item->id ? 'selected' : null  }}>

																				{{ $item->name }}

																			</option>

																		@endforeach

																	</select>

																</td>

																<td><input type="text" class="form-control" name="product_attributes[{{ $loop->index + 1 }}][key]" value="{{ $attribute->key }}" required=""></td>

															    <td style="text-align: center;">

															        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">

															            <i class="fa fa-minus"></i>

															        </a>

															    </td>

															</tr>

							                    		@endforeach

							                    	@endif

												</tbody>

							                </table>

							               	<div class="text-right">

							                    <button class="btn btn-primary" onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'products-attributes')">Thêm</button>

						                	</div>

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

		                    <h3 class="box-title">Đăng sản phẩm</h3>

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

		                            	<input type="checkbox" name="is_hot" value="1" {{ @$data->is_hot == 1 ? 'checked' : null }}> Nổi bật

		                            @else

		                            	<input type="checkbox" name="is_hot" value="1"> Nổi bật

		                            @endif

		                        </label>

								<label class="custom-checkbox">

									@if(isUpdate(@$module['action']))

										<input type="checkbox" name="is_flash_sale" value="1" {{ @$data->is_flash_sale == 1 ? 'checked' : null }}> Sản phẩm bán chạy

									@else

		                            	<input type="checkbox" name="is_flash_sale" value="1"> Sản phẩm bán chạy

		                            @endif

		                        </label>

		                    </div>

		                    <div class="form-group text-right">

		                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại sản phẩm</button>

		                    </div>

		                </div>

		            </div>

		            <div class="box box-success category-box">

		                <div class="box-header with-border">

		                    <h3 class="box-title">Danh mục sản phẩm </h3>

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

		                    <h3 class="box-title">Ảnh sản phẩm</h3>

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

		            <div class="box box-success">

		                <div class="box-header with-border">

		                    <h3 class="box-title">Hình ảnh hover sản phẩm</h3>

		                </div>

		                <div class="box-body">

		                    <div class="form-group" style="text-align: center;">

		                        <div class="image">

		                            <div class="image__thumbnail">

		                                <img src="{{ !empty(@$data->image_hover) ? @$data->image_hover : __IMAGE_DEFAULT__ }}"

		                                     data-init="{{ __IMAGE_DEFAULT__ }}">

		                                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">

		                                    <i class="fa fa-times"></i></a>

		                                <input type="hidden" value="{{ old('image_hover', @$data->image_hover) }}" name="image_hover"/>

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

	<div id="myModal-spkh" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Vui lòng chọn sản phẩm kết hợp</h4>
			</div>
			<div class="modal-body modal-products-spkh">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="selected-products">Áp dụng</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
			</div>
			</div>

		</div>
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

			$('.spkh-show').on('click',function(){

				var text = '';

				$('#myModal-spkh').modal('show');

				$(".spkh_item").each(function () {
					var id_pr = $(this).val();
					text+=id_pr+',';
				});

				string = text.substring(0, text.length - 1);

				$.ajax({
					
					url: '{{ route('products.get-all') }}?id='+string,

					type: 'GET',

					})

					.done(function(data) {

					$('.modal-products-spkh').html(data);



				});
			});
			
			$('#selected-products').on('click',function(){
				var html="";
				$("input[name='product_item_checkbox']:checked").each(function () {
					var id = $(this).data("id");
					var img = $(this).data("img");
					var name = $(this).data("name");
					html+='<tr>'+
							'<td>'+
								'<div class="img-item">'+
									'<img src="'+img+'">'+
								'</div>'+
							'</td>'+
							'<td>'+
								'<div>'+name+'</div>'+
								'<input class="spkh_item" type="hidden" name="spkh_id[]" value="'+id+'">'+
							'</td>'+
							'<td style="text-align: center;">'+
								'<a href="javascript:void(0);" onclick="" class="text-danger buttonremovetable" title="Xóa">'+
									'<i class="fa fa-minus"></i>'+
								'</a>'+
							'</td>'+
						'</tr>';
				});

				$('.spkh-selected').html(html);

				$('#myModal-spkh').modal('hide');
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

		        	url: '{{ route('products.get-slug') }}',

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

	<script>

		jQuery(document).ready(function($) {

			$('.btn-edit-questions').click(function(event) {

				$('#content_questions_edit').val($(this).data('content'));

				$('#frm-edit-questions-edit').attr('action', $(this).data('href'));

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



			$('#reservation').daterangepicker({

		         autoUpdateInput: false,

		         "locale": {

		            "format": "DD-MM-YYYY",

		            "applyLabel": "Áp dụng",

		            "cancelLabel": "Hủy bỏ",

		            "daysOfWeek": [

		                "T2",

		                "T3",

		                "T4",

		                "T5",

		                "T6",

		                "T7",

		                "CN"

		            ],

		            "monthNames": [

		                "Tháng 1 - ",

		                "Tháng 2 - ",

		                "Tháng 3 - ",

		                "Tháng 4 - ",

		                "Tháng 5 - ",

		                "Tháng 6 - ",

		                "Tháng 7 - ",

		                "Tháng 8 - ",

		                "Tháng 9 - ",

		                "Tháng 10 - ",

		                "Tháng 11 - ",

		                "Tháng 12 - "

		            ]

		        }

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

		    @if (!empty($time_priority))

		    	<?php $time_priority = explode(' - ', $time_priority); ?>

		    	order = { order_sdate : "{{ $time_priority[0] }}", order_edate : "{{ $time_priority[1] }}" };

				jQuery( "#reservation" ).val( order.order_sdate + " - " + order.order_edate );

				jQuery( "#reservation" ).data('daterangepicker').startDate = moment( order.order_sdate, "DD-MM-YYYY" );

				jQuery( "#reservation" ).data('daterangepicker').endDate = moment( order.order_edate, "DD-MM-YYYY" );

				jQuery( "#reservation" ).data('daterangepicker').updateView();

				jQuery( "#reservation" ).data('daterangepicker').updateCalendars();

		    @endif

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