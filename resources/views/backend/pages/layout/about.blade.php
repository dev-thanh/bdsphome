@extends('backend.layouts.app')
@section('controller','Trang')
@section('controller_route',route('pages.list'))
@section('action','Danh sách')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<form action="{{ route('pages.build.post') }}" method="POST">
					{{ csrf_field() }}
					<input name="type" value="{{ $data->type }}" type="hidden">

	               	<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">Trang</label>
								<input type="text" class="form-control" value="{{ $data->name_page }}" disabled="">
				 				
								@if (\Route::has($data->route))
									<h5>
										<a href="{{ route($data->route) }}" target="_blank">
					                        <i class="fa fa-hand-o-right" aria-hidden="true"></i>
					                        Link: {{ route($data->route) }}
					                    </a>
									</h5>
				                @endif
							</div>
							
						</div>
					</div>
					<div class="nav-tabs-custom">
				        <ul class="nav nav-tabs">
							<li class="active">
								<a href="#introduce1" data-toggle="tab" aria-expanded="true">Khối giới thiệu</a>
				            </li>
							<li class="">
								<a href="#introduce2" data-toggle="tab" aria-expanded="true">Khối tầm nhìn sứ mệnh</a>
							</li>
				        	<li class="">
								<a href="#introduce3" data-toggle="tab" aria-expanded="true">Giá trị cốt lõi</a>
				            </li>
							<li class="">
								<a href="#seo" data-toggle="tab" aria-expanded="true">Cấu hình trang</a>
							</li>
							
				        </ul>
					</div>
					<?php if(!empty($data->content)){                                             
						$content = json_decode($data->content);
					} ?>
				    <div class="tab-content">

						<div class="tab-pane active" id="introduce1">
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
			                           <label>Hình ảnh đại diện khối(bên phải)</label>
			                           <div class="image">
			                               <div class="image__thumbnail">
			                                   <img src="{{ @$content->introduce->image ?  url('/').@$content->introduce->image : __IMAGE_DEFAULT__ }}"  
			                                   data-init="{{ __IMAGE_DEFAULT__ }}">
			                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
			                                    <i class="fa fa-times"></i></a>
			                                   <input type="hidden" value="{{ @$content->introduce->image }}" name="content[introduce][image]"  />
			                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
			                               </div>
			                           </div>
			                       </div>
								</div>
								<div class="col-sm-10">
									<div class="form-group">
										<label for="">Tiêu đề khối</label>
										<input class="form-control" name="content[introduce][title]" value="{{ @$content->introduce->title }}">
									</div>
									<div class="form-group">
										<label for="">Mô tả khối</label>
										<textarea class="content" name="content[introduce][content]">{!! @$content->introduce->content !!}</textarea>
									</div>
								</div>
								<div class="col-sm-12">
									<h3 class="text-center" style="background: #62ff00;padding: 10px 0px">Thông số thống kê</h3>
									<div class="form-group">
										<div class="repeater" id="repeater">
											<table class="table table-bordered table-hover statistical">
												
												<?php if(!empty($data->content)){
													$contents = json_decode($data->content);
													//dd(@$contents);
												} ?>
												<tbody id="sortable">
													@if(!empty(@$contents->statistical->content))
														@foreach (@$content->statistical->content as $key => $value)
															<?php $index = $loop->index + 1; ?>
															@include('backend.repeater.row-statistical')
														@endforeach
													@endif
												</tbody>
											</table>
											<div class="text-right">
												
												<button class="btn btn-primary" 
													onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'statistical', '.statistical')">Thêm
												</button>
												
											</div>
										</div>
									</div>
								</div>

								<div class="col-sm-12">
									<h3 class="text-center" style="background: #ffd0d0;padding: 10px 0px">Danh sách logo đối tác</h3>
									<div class="form-group">
										<div class="repeater" id="repeater">
											<table class="table table-bordered table-hover logo">
												
												<?php if(!empty($data->content)){
													$contents = json_decode($data->content);
													//dd(@$contents);
												} ?>
												<tbody id="sortable">
													@if(!empty(@$contents->logo->content))
														@foreach (@$content->logo->content as $key => $value)
															<?php $index = $loop->index + 1; ?>
															@include('backend.repeater.row-logo')
														@endforeach
													@endif
												</tbody>
											</table>
											<div class="text-right">
												
												<button class="btn btn-primary" 
													onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'logo', '.logo')">Thêm
												</button>
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="tab-pane" id="introduce2">
							<div class="row">
								<div class="col-sm-12">
									<div class="repeater" id="repeater">
										<table class="table table-bordered table-hover noidungbaihoc">
											
											<?php if(!empty($data->content)){
												$contents = json_decode($data->content);
												//dd(@$contents);
											} ?>
											<tbody id="sortable">
												@if(!empty(@$contents->noidungbaihoc))
													@foreach (@$content->noidungbaihoc->content as $key => $value)
														<?php $index = $loop->index + 1; ?>
														@include('backend.repeater.row-noidungbaihoc')
													@endforeach
												@endif
											</tbody>
										</table>
										<div class="text-right">
											
											<button class="btn btn-primary" 
												onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'noidungbaihoc', '.noidungbaihoc')">Thêm
											</button>
											
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="introduce3">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="">Tiêu đề khối</label>
										<input class="form-control" name="content[core_value][title]" value="{{ @$content->core_value->title }}">
									</div>
									<div class="repeater" id="repeater">
										<table class="table table-bordered table-hover core_value">
											
											<?php if(!empty($data->content)){
												$contents = json_decode($data->content);
												//dd(@$contents);
											} ?>
											<tbody id="sortable">
												@if(!empty(@$contents->core_value))
													@foreach (@$content->core_value->content as $key => $value)
														<?php $index = $loop->index + 1; ?>
														@include('backend.repeater.row-core_value')
													@endforeach
												@endif
											</tbody>
										</table>
										<div class="text-right">
											
											<button class="btn btn-primary" 
												onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'core_value', '.core_value')">Thêm
											</button>
											
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="seo">
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
			                           <label>Hình ảnh</label>
			                           <div class="image">
			                               <div class="image__thumbnail">
			                                   <img src="{{ $data->image ?  url('/').$data->image : __IMAGE_DEFAULT__ }}"  
			                                   data-init="{{ __IMAGE_DEFAULT__ }}">
			                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
			                                    <i class="fa fa-times"></i></a>
			                                   <input type="hidden" value="{{ @$data->image }}" name="image"  />
			                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
			                               </div>
			                           </div>
			                       </div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
			                           <label>Background trang</label>
			                           <div class="image">
			                               <div class="image__thumbnail">
			                                   <img src="{{ $data->banner ?  url('/').$data->banner : __IMAGE_DEFAULT__ }}"  
			                                   data-init="{{ __IMAGE_DEFAULT__ }}">
			                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
			                                    <i class="fa fa-times"></i></a>
			                                   <input type="hidden" value="{{ @$data->banner }}" name="banner"  />
			                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
			                               </div>
			                           </div>
			                       </div>
								</div>
								<div class="col-sm-8">
									<div class="form-group">
										<label for="">Tiêu đề trang</label>
										<input type="text" name="meta_title" class="form-control" value="{{ @$data->meta_title }}">
									</div>
									<div class="form-group">
										<label for="">Mô tả trang</label>
										<textarea name="meta_description" 
										class="form-control" rows="5">{!! @$data->meta_description !!}</textarea>
									</div>
									<div class="form-group">
										<label for="">Từ khóa</label>
										<input type="text" name="meta_keyword" class="form-control" value="{!! @$data->meta_keyword !!}">
									</div>
								</div>
							</div>
			            </div>
			           <button type="submit" class="btn btn-primary">Lưu lại</button>
			        </div>
				</form>
			</div>
		</div>
	</div>
@stop